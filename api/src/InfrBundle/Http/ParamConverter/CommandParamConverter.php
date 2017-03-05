<?php

namespace InfrBundle\Http\ParamConverter;

use InfrBundle\Http\Exception\ValidationException;
use InfrBundle\Service\CommandTagInterface;
use InfrBundle\Uid\Uid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CommandParamConverter constructor.
     * @param ValidatorInterface $validator
     * @param JsonMapper $mapper
     * @param TokenStorageInterface $tokenStorage$tokenStorage
     */
    public function __construct(ValidatorInterface $validator, JsonMapper $mapper, TokenStorageInterface $tokenStorage)
    {
        $this->validator = $validator;
        $this->mapper = $mapper;
        $this->tokenStorage = $tokenStorage;
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

        if ($options['auth'] ?? false && null !== $this->tokenStorage->getToken()) {
            $authPropertyName = $options['auth'];
            $command->$authPropertyName = $this->tokenStorage->getToken()->getUser();
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
        return is_subclass_of($configuration->getClass(), CommandTagInterface::class);
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
