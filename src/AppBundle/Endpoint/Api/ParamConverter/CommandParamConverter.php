<?php

namespace AppBundle\Endpoint\Api\ParamConverter;

use AppBundle\Endpoint\Api\Exception\ValidationException;
use AppBundle\Handler\CommandTag;
use AppBundle\Infr\Uid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\{
    Encoder\JsonEncoder,
    NameConverter\CamelCaseToSnakeCaseNameConverter,
    Normalizer\ObjectNormalizer,
    Serializer
};
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * Class RequestMapper
 * @package AppBundle\Infr\Request
 */
class CommandParamConverter implements ParamConverterInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * CommandParamConverter constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;

        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $this->serializer = new Serializer([$normalizer], [new JsonEncoder()]);
    }

    /**
     * @inheritdoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $class = $configuration->getClass();

        $command = $this->serializer->deserialize($request->getContent(), $class, JsonEncoder::FORMAT);

        $options = $configuration->getOptions();

        if (array_key_exists('auto_uid', $options)) {
            $propertyName = $options['auto_uid'];
            $command->$propertyName = Uid::make();
        }

        if (array_key_exists('validation', $options) && $options['validation'] !== false) {
            $errors = $this->validator->validate($command);
            throw new ValidationException($errors);
        }

        $request->attributes->set(
            $configuration->getName(),
            $command
        );
    }

    /**
     * @inheritdoc
     */
    public function supports(ParamConverter $configuration)
    {
        return is_subclass_of($configuration->getClass(), CommandTag::class);
    }
}