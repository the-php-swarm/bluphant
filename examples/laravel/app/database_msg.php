<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: database.proto

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>database_msg</code>
 */
class database_msg extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.database_header header = 2;</code>
     */
    private $header = null;
    protected $msg;

    public function __construct() {
        \GPBMetadata\Database::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.database_header header = 2;</code>
     * @return \database_header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Generated from protobuf field <code>.database_header header = 2;</code>
     * @param \database_header $var
     * @return $this
     */
    public function setHeader($var)
    {
        GPBUtil::checkMessage($var, \database_header::class);
        $this->header = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_create create = 10;</code>
     * @return \database_create
     */
    public function getCreate()
    {
        return $this->readOneof(10);
    }

    /**
     * Generated from protobuf field <code>.database_create create = 10;</code>
     * @param \database_create $var
     * @return $this
     */
    public function setCreate($var)
    {
        GPBUtil::checkMessage($var, \database_create::class);
        $this->writeOneof(10, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_read read = 11;</code>
     * @return \database_read
     */
    public function getRead()
    {
        return $this->readOneof(11);
    }

    /**
     * Generated from protobuf field <code>.database_read read = 11;</code>
     * @param \database_read $var
     * @return $this
     */
    public function setRead($var)
    {
        GPBUtil::checkMessage($var, \database_read::class);
        $this->writeOneof(11, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_update update = 12;</code>
     * @return \database_update
     */
    public function getUpdate()
    {
        return $this->readOneof(12);
    }

    /**
     * Generated from protobuf field <code>.database_update update = 12;</code>
     * @param \database_update $var
     * @return $this
     */
    public function setUpdate($var)
    {
        GPBUtil::checkMessage($var, \database_update::class);
        $this->writeOneof(12, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_delete delete = 13;</code>
     * @return \database_delete
     */
    public function getDelete()
    {
        return $this->readOneof(13);
    }

    /**
     * Generated from protobuf field <code>.database_delete delete = 13;</code>
     * @param \database_delete $var
     * @return $this
     */
    public function setDelete($var)
    {
        GPBUtil::checkMessage($var, \database_delete::class);
        $this->writeOneof(13, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_has has = 14;</code>
     * @return \database_has
     */
    public function getHas()
    {
        return $this->readOneof(14);
    }

    /**
     * Generated from protobuf field <code>.database_has has = 14;</code>
     * @param \database_has $var
     * @return $this
     */
    public function setHas($var)
    {
        GPBUtil::checkMessage($var, \database_has::class);
        $this->writeOneof(14, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_empty keys = 15;</code>
     * @return \database_empty
     */
    public function getKeys()
    {
        return $this->readOneof(15);
    }

    /**
     * Generated from protobuf field <code>.database_empty keys = 15;</code>
     * @param \database_empty $var
     * @return $this
     */
    public function setKeys($var)
    {
        GPBUtil::checkMessage($var, \database_empty::class);
        $this->writeOneof(15, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.database_empty size = 16;</code>
     * @return \database_empty
     */
    public function getSize()
    {
        return $this->readOneof(16);
    }

    /**
     * Generated from protobuf field <code>.database_empty size = 16;</code>
     * @param \database_empty $var
     * @return $this
     */
    public function setSize($var)
    {
        GPBUtil::checkMessage($var, \database_empty::class);
        $this->writeOneof(16, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->whichOneof("msg");
    }

}

