<?php

namespace Infr\Http\ParamConverter;

use AppBundle\Endpoint\Api\Exception\ValidationException;
use AppBundle\Handler\CommandTag;
use AppBundle\Infr\Uid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use JsonMapper;

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
     * @var JsonMapper
     */
    private $mapper;

    /**
     * CommandParamConverter constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator, JsonMapper $mapper)
    {
        $this->validator = $validator;
        $this->mapper = $mapper;
    }

    /**
     * @inheritdoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $class = $configuration->getClass();

        $command = $this->mapper->map($this->decodeBody($request), new $class);

        //TODO: Update options
        $options = $configuration->getOptions();

        if ($options['auto_uid'] ?? false) {
            $propertyName = $options['auto_uid'];
            $command->$propertyName = Uid::make();
        }

        if ($options['validation'] ?? true) {
            $errors = $this->validator->validate($command);
            if ($errors->count() > 0) {
                throw new ValidationException($errors);
            }
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

    /**
     * @param Request $request
     * @return \stdClass|array
     */
    private function decodeBody(Request $request)
    {
        return json_decode($request->getContent());
    }
}
