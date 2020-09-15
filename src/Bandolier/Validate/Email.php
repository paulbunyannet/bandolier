<?php

namespace Pbc\Bandolier\Validate;

use Pbc\Bandolier\Exception\Setup\ArrayRequired;

/**
 * Class Email
 * @package Pbc\Bandolier\Validate
 */
class Email
{
    protected array $filters = ['filter', 'dns'];
    protected bool $valid = false;

    /**
     * Validate an email address
     *
     * @param string $email
     * @return bool
     */
    public static function validate(string $email)
    {
        $validate = new Email();
        foreach ($validate->getFilters() as $filter) {
            $v = $validate->{'check' . ucfirst($filter)}($email);
            if ($v) {
                $validate->setValid(true);
            } else {
                $validate->setValid(false);
                break;
            }
        }

        return $validate->isValid();
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function checkDns(string $email)
    {
        // Next check the domain is real.
        $domain = explode("@", $email, 2);
        return checkdnsrr($domain[1]);
    }

    /**
     * @param string $email
     *
     * @return mixed
     */
    public function checkFilter(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     *
     * @throws \TypeError
     *
     * @return void
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     *
     * @return void
     */
    public function setValid(bool $valid)
    {
        $this->valid = $valid;
    }
}
