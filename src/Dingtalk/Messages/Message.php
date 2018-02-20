<?php
/**
 * Created by PhpStorm.
 * User: yemeishu
 * Date: 2018/2/20
 * Time: 下午3:21
 */
namespace Fanly\Msgrobot\Dingtalk\Messages;

use Fanly\Msgrobot\Contracts\MessageInterface;
use Fanly\Msgrobot\Traits\HasAttributes;

class Message implements MessageInterface {
    use HasAttributes;

    const TEXT = 2;
    const LINK = 4;
    const VOICE = 8;
    const VIDEO = 16;
    const SHORT_VIDEO = 32;
    const LOCATION = 64;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $from;

    /*
     * @var bool
     */
    protected $hasAt = false;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var array
     */
    protected $jsonAliases = [];

    /**
     * Message constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     * Return type name message.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function getHasAt(): bool
    {
        return $this->hasAt;
    }

    /**
     * @param bool $hasAt
     */
    public function setHasAt(bool $hasAt)
    {
        $this->hasAt = $hasAt;
    }

    /**
     * Magic getter.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return $this->getAttribute($property);
    }

    /**
     * Magic setter.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return Message
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            $this->setAttribute($property, $value);
        }

        return $this;
    }

    /**
     * @param array $appends
     *
     * @return array
     */
    public function transformForJsonRequestWithoutType(array $appends = [])
    {
        return $this->transformForJsonRequest($appends, false);
    }

    /**
     * @param array $appends
     * @param bool  $withType
     *
     * @return array
     */
    public function transformForJsonRequest(array $appends = [], $at = [], $withType = true): array
    {
        if (!$withType) {
            return $this->propertiesToArray([], $this->jsonAliases);
        }
        $messageType = $this->getType();
        $data = array_merge(['msgtype' => $messageType], $appends);

        $data[$messageType] = array_merge($data[$messageType] ?? [], $this->propertiesToArray([], $this->jsonAliases));

        if ($this->getHasAt()) {
            $data['at'] = $at;
        }

        return $data;
    }

    /**
     * @param array $appends
     * @param bool  $returnAsArray
     *
     * @return string
     */
    public function transformToXml(array $appends = [], bool $returnAsArray = false): string
    {
        $data = array_merge(['MsgType' => $this->getType()], $this->toXmlArray(), $appends);

        return $returnAsArray ? $data : XML::build($data);
    }

    /**
     * @param array $data
     * @param array $aliases
     *
     * @return array|mixed
     */
    protected function propertiesToArray(array $data, array $aliases = []): array
    {
        $this->checkRequiredAttributes();

        foreach ($this->attributes as $property => $value) {
            if (is_null($value) && !$this->isRequired($property)) {
                continue;
            }
            $alias = array_search($property, $aliases, true);

            $data[$alias ?: $property] = $this->get($property);
        }

        return $data;
    }

    public function toXmlArray()
    {
        throw new BadMethodCallException(sprintf('Class "%s" cannot support transform to XML message.', __CLASS__));
    }
}