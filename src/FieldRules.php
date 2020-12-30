<?php

namespace Spe11\LaravelValidator;

use InvalidArgumentException;

class FieldRules
{
    private $field;
    private $rules = [];

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Add custom rule
     */
    public function custom($rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * The field under validation must be yes, on, 1, or true. This is useful for validating "Terms of Service" acceptance.
     */
    public function accepted()
    {
        $this->rules[] = 'accepted';

        return $this;
    }

    /**
     * The field under validation must have a valid A or AAAA record according to the dns_get_record PHP function.
     * The hostname of the provided URL is extracted using the parse_url PHP function before being passed to dns_get_record.
     */
    public function activeUrl()
    {
        $this->rules[] = 'active_url';

        return $this;
    }

    /**
     * The field under validation must be a value after a given date. The dates will be passed into the strtotime PHP function.
     * Instead of passing a date string to be evaluated by strtotime, you may specify another field to compare against the date.
     */
    public function after(string $dateOrField)
    {
        $this->rules[] = "after:$dateOrField";

        return $this;
    }

    /**
     * The field under validation must be a value after or equal to given date. The dates will be passed into the strtotime PHP function.
     * Instead of passing a date string to be evaluated by strtotime, you may specify another field to compare against the date.
     */
    public function afterOrEqual(string $dateOrField)
    {
        $this->rules[] = "after_or_equal:$dateOrField";

        return $this;
    }

    /**
     * The field under validation must be entirely alphabetic characters.
     */
    public function alpha()
    {
        $this->rules[] = 'alpha';

        return $this;
    }

    /**
     * The field under validation may have alpha-numeric characters, as well as dashes and underscores.
     */
    public function alphaDash()
    {
        $this->rules[] = 'alpha_dash';

        return $this;
    }

    /**
     * The field under validation must be entirely alpha-numeric characters.
     */
    public function alphaNum()
    {
        $this->rules[] = 'alpha_num';

        return $this;
    }

    /**
     * The field under validation must be a PHP array.
     */
    public function array()
    {
        $this->rules[] = 'array';

        return $this;
    }

    /**
     * Stop running validation rules after the first validation failure.
     */
    public function bail()
    {
        $this->rules[] = 'bail';

        return $this;
    }

    /**
     * The field under validation must be a value preceding a given date. The dates will be passed into the strtotime PHP function.
     * Instead of passing a date string to be evaluated by strtotime, you may specify another field to compare against the date.
     */
    public function before(string $dateOrField)
    {
        $this->rules[] = "before:$dateOrField";

        return $this;
    }

    /**
     * The field under validation must be a value preceding or equal to given date. The dates will be passed into the strtotime PHP function.
     * Instead of passing a date string to be evaluated by strtotime, you may specify another field to compare against the date.
     */
    public function beforeOrEqual(string $dateOrField)
    {
        $this->rules[] = "before_or_equal:$dateOrField";

        return $this;
    }

    /**
     * The field under validation must have a size between the given min and max. Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
     */
    public function between(int $min, int $max)
    {
        $this->rules[] = "between:$min,$max";

        return $this;
    }

    /**
     * The field under validation must be able to be cast as a boolean. Accepted input are true, false, 1, 0, "1", and "0".
     */
    public function boolean()
    {
        $this->rules[] = 'boolean';

        return $this;
    }

    /**
     * The field under validation must have a matching field of foo_confirmation.
     * For example, if the field under validation is password, a matching password_confirmation field must be present in the input.
     */
    public function confirmed()
    {
        $this->rules[] = 'confirmed';

        return $this;
    }

    /**
     * The field under validation must be a valid, non-relative date according to the strtotime PHP function.
     */
    public function date()
    {
        $this->rules[] = 'date';

        return $this;
    }

    /**
     * The field under validation must be equal to the given date. The dates will be passed into the PHP strtotime function.
     */
    public function dateEquals(string $date)
    {
        $this->rules[] = "date_equals:$date";

        return $this;
    }

    /**
     * The field under validation must match the given format. You should use either date or date_format when validating a field, not both.
     * This validation rule supports all formats supported by PHP's DateTime class.
     */
    public function dateFormat(string $format)
    {
        $this->rules[] = "date_format:$format";

        return $this;
    }

    /**
     * The field under validation must have a different value than field.
     */
    public function different(string $field)
    {
        $this->rules[] = "different:$field";

        return $this;
    }

    /**
     * The field under validation must be numeric and must have an exact length of value.
     */
    public function digits(int $value)
    {
        $this->rules[] = "digits:$value";

        return $this;
    }

    /**
     * The field under validation must be numeric and must have a length between the given min and max.
     */
    public function digitsBetween(int $min, int $max)
    {
        $this->rules[] = "digits_between:$min,$max";

        return $this;
    }

    /**
     * The file under validation must be an image meeting the dimension constraints as specified by the rule's parameters.
     */
    public function dimensions(?int $minWidth = null, ?int $maxWidth = null, ?int $minHeight = null, ?int $maxHeight = null, ?int $width = null, ?int $height = null, ?float $ratio = null)
    {
        $rules = [];

        if ($minWidth !== null) {
            $rules[] = "min_width=$minWidth";
        }
        if ($maxWidth !== null) {
            $rules[] ="max_width=$maxWidth";
        }
        if ($minHeight !== null) {
            $rules[] = "min_height=$minHeight";
        }
        if ($maxHeight !== null) {
            $rules[] = "max_height=$maxHeight";
        }
        if ($width !== null) {
            $rules[] = "width=$width";
        }
        if ($height !== null) {
            $rules[] = "height=$height";
        }
        if ($ratio !== null) {
            $rules[] = "ratio=$ratio";
        }

        if (false === empty($rules)) {
            $this->rules[] = 'dimensions:' . implode(',', $rules);
        }

        return $this;
    }

    /**
     * When working with arrays, the field under validation must not have any duplicate values.
     */
    public function distinct()
    {
        $this->rules[] = 'distinct';

        return $this;
    }

    /**
     * The field under validation must be formatted as an e-mail address. Under the hood, this validation rule makes use of the egulias/email-validator package for validating the email address.
     * By default the RFCValidation validator is applied, but you can apply other validation styles as well.
     * Here's a full list of validation styles you can apply: rfc: RFCValidation, strict: NoRFCWarningsValidation, dns: DNSCheckValidation, spoof: SpoofCheckValidation, filter: FilterEmailValidation.
     * The filter validator, which uses PHP's filter_var function under the hood, ships with Laravel and is Laravel's pre-5.8 behavior. The dns and spoof validators require the PHP intl extension.
     */
    public function email(array $types)
    {
        foreach ($types as $type) {
            if (!in_array($type, [
                Validator::EMAIL_DNS,
                Validator::EMAIL_FILTER,
                Validator::EMAIL_RFC,
                Validator::EMAIL_SPOOF,
                Validator::EMAIL_STRICT
            ])) {
                throw new InvalidArgumentException('Invalid email validator format');
            }
        }

        $typeList = '';

        if (false === empty($types)) {
            $typeList = implode(',', $types);
            $typeList = ':' . $typeList;
        }
        $this->rules[] = 'email' . $typeList;

        return $this;
    }

    /**
     * The field under validation must end with one of the given values.
     */
    public function endsWith(array $values)
    {
        $this->rules[] = 'ends_with:' . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation will be excluded from the request data returned by the validate and validated methods if the anotherfield field is equal to value.
     */
    public function excludeIf(string $field, string $value)
    {
        $this->rules[] = "exclude_if:$field,$value";

        return $this;
    }

    /**
     * The field under validation will be excluded from the request data returned by the validate and validated methods unless the anotherfield field is equal to value.
     */
    public function excludeUnless(string $field, string $value)
    {
        $this->rules[] = "exclude_unless:$field,$value";

        return $this;
    }

    /**
     * The field under validation must exist in a given database table.
     */
    public function exists(string $source, ?string $column = null, ?string $dbConnection = null)
    {
        $rule = "exists:";

        $rule .= null === $dbConnection ? $source : "$dbConnection.$source";

        if ($column !== null) {
            $rule .= ",$column";
        }

        $this->rules[] = $rule;

        return $this;
    }

    /**
     * The field under validation must be a successfully uploaded file.
     */
    public function file()
    {
        $this->rules[] = 'file';

        return $this;
    }

    /**
     * The field under validation must not be empty when it is present.
     */
    public function filled()
    {
        $this->rules[] = 'filled';

        return $this;
    }

    /**
     * The field under validation must be greater than the given field. The two fields must be of the same type.
     * Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.
     */
    public function gt(string $field)
    {
        $this->rules[] = "gt:$field";

        return $this;
    }

    /**
     * The field under validation must be greater than or equal to the given field. The two fields must be of the same type.
     * Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.
     */
    public function gte(string $field)
    {
        $this->rules[] = "gte:$field";

        return $this;
    }

    /**
     * The file under validation must be an image (jpg, jpeg, png, bmp, gif, svg, or webp).
     */
    public function image()
    {
        $this->rules[] = 'image';

        return $this;
    }

    /**
     * The field under validation must be included in the given list of values.
     */
    public function in(array $values)
    {
        $this->rules[] = 'in:' . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation must exist in another field's values.
     */
    public function inArray(string $field)
    {
        $this->rules[] = "in_array:$field";

        return $this;
    }

    /**
     * The field under validation must be an integer.
     * This validation rule does not verify that the input is of the "integer" variable type, only that the input is a string or numeric value that contains an integer.
     */
    public function integer()
    {
        $this->rules[] = 'integer';

        return $this;
    }

    /**
     * The field under validation must be an IP address.
     */
    public function ip()
    {
        $this->rules[] = 'ip';

        return $this;
    }

    /**
     * The field under validation must be an IPv4 address.
     */
    public function ip4()
    {
        $this->rules[] = 'ip4';

        return $this;
    }

    /**
     * The field under validation must be an IPv6 address.
     */
    public function ip6()
    {
        $this->rules[] = 'ip6';

        return $this;
    }

    /**
     * The field under validation must be a valid JSON string.
     */
    public function json()
    {
        $this->rules[] = 'json';

        return $this;
    }

    /**
     * The field under validation must be less than the given field. The two fields must be of the same type.
     * Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.
     */
    public function lt(string $field)
    {
        $this->rules[] = "lt:$field";

        return $this;
    }

    /**
     * The field under validation must be less than or equal to the given field. The two fields must be of the same type.
     * Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.
     */
    public function lte(string $field)
    {
        $this->rules[] = "lte:$field";

        return $this;
    }

    /**
     * The field under validation must be less than or equal to a maximum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
     */
    public function max(int $value)
    {
        $this->rules[] = "max:$value";

        return $this;
    }

    /**
     * The file under validation must match one of the given MIME types.
     * To determine the MIME type of the uploaded file, the file's contents will be read and the framework will attempt to guess the MIME type, which may be different from the client's provided MIME type.
     */
    public function mimeTypes(array $values)
    {
        $this->rules[] = 'mimetypes:' . implode(',', $values);

        return $this;
    }

    /**
     * The file under validation must have a MIME type corresponding to one of the listed extensions.
     * Even though you only need to specify the extensions, this rule actually validates the MIME type of the file by reading the file's contents and guessing its MIME type.
     * A full listing of MIME types and their corresponding extensions may be found at the following location: https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
     */
    public function mimes(array $values)
    {
        $this->rules[] = 'mimes:' . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation must have a minimum value.
     * Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
     */
    public function min(int $value)
    {
        $this->rules[] = "min:$value";

        return $this;
    }

    /**
     * The field under validation must be a multiple of value.
     */
    public function multipleOf(int $value)
    {
        $this->rules[] = "multiple_of:$value";

        return $this;
    }

    /**
     * The field under validation must not be included in the given list of values.
     */
    public function notIn(array $values)
    {
        $this->rules[] = 'notIn:' . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation must not match the given regular expression.
     * Internally, this rule uses the PHP preg_match function. The pattern specified should obey the same formatting required by preg_match and thus also include valid delimiters. For example: 'email' => 'not_regex:/^.+$/i'.
     */
    public function notRegex(string $pattern)
    {
        $this->rules[] = "not_regex:$pattern";

        return $this;
    }

    /**
     * The field under validation may be null.
     */
    public function nullable()
    {
        $this->rules[] = 'nullable';

        return $this;
    }

    /**
     * The field under validation must be numeric.
     */
    public function numeric()
    {
        $this->rules[] = 'numeric';

        return $this;
    }

    /**
     * The field under validation must match the authenticated user's password. You may specify an authentication guard using the rule's first parameter.
     */
    public function password(?string $guard = null)
    {
        $rule = 'password';
        if ($guard !== null) {
            $rule .= ":$guard";
        }

        $this->rules[] = $rule;

        return $this;
    }

    /**
     * The field under validation must be present in the input data but can be empty.
     */
    public function present()
    {
        $this->rules[] = 'present';

        return $this;
    }

    /**
     * The field under validation must match the given regular expression.
     * Internally, this rule uses the PHP preg_match function. The pattern specified should obey the same formatting required by preg_match and thus also include valid delimiters. For example: 'email' => 'not_regex:/^.+$/i'.
     */
    public function regex(string $pattern)
    {
        $this->rules[] = "regex:$pattern";

        return $this;
    }

    /**
     * The field under validation must be present in the input data and not empty. A field is considered "empty" if one of the following conditions are true:
     * The value is null. The value is an empty string. The value is an empty array or empty Countable object. The value is an uploaded file with no path.
     */
    public function required()
    {
        $this->rules[] = 'required';

        return $this;
    }

    /**
     * The field under validation must be present and not empty if the another field is equal to any value.
     */
    public function requiredIf(string $field, array $values)
    {
        $this->rules[] = "required_if:$field," . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation must be present and not empty unless the another field is equal to any value.
     */
    public function requiredUnless(string $field, array $values)
    {
        $this->rules[] = "required_unless:$field," . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation must be present and not empty only if any of the other specified fields are present.
     */
    public function requiredWith(array $fields)
    {
        $this->rules[] = 'required_with' . implode(',', $fields);

        return $this;
    }

    /**
     * The field under validation must be present and not empty only if all of the other specified fields are present.
     */
    public function requiredWithAll(array $fields)
    {
        $this->rules[] = 'required_with_all' . implode(',', $fields);

        return $this;
    }

    /**
     * The field under validation must be present and not empty only when any of the other specified fields are not present.
     */
    public function requiredWithout(array $fields)
    {
        $this->rules[] = 'required_without' . implode(',', $fields);

        return $this;
    }

    /**
     * The field under validation must be present and not empty only when all of the other specified fields are not present.
     */
    public function requiredWithoutAll(array $fields)
    {
        $this->rules[] = 'required_without_all' . implode(',', $fields);

        return $this;
    }

    /**
     * The given field must match the field under validation.
     */
    public function same(string $field)
    {
        $this->rules[] = "same:$field";

        return $this;
    }

    /**
     * The field under validation must have a size matching the given value.
     * For string data, value corresponds to the number of characters. For numeric data, value corresponds to a given integer value (the attribute must also have the numeric or integer rule). For an array, size corresponds to the count of the array. For files, size corresponds to the file size in kilobytes.
     */
    public function size(int $value)
    {
        $this->rules[] = "size:$value";

        return $this;
    }

    /**
     * The field under validation must start with one of the given values.
     */
    public function startsWith(array $values)
    {
        $this->rules[] = 'starts_with:' . implode(',', $values);

        return $this;
    }

    /**
     * The field under validation must be a string. If you would like to allow the field to also be null, you should assign the nullable rule to the field.
     */
    public function string()
    {
        $this->rules[] = 'string';

        return $this;
    }

    /**
     * The field under validation must be a valid timezone identifier according to the timezone_identifiers_list PHP function.
     */
    public function timezone()
    {
        $this->rules[] = 'timezone';

        return $this;
    }

    /**
     * The field under validation must not exist within the given database table.
     * Instead of specifying the table name directly, you may specify the Eloquent model which should be used to determine the table name.
     * The column option may be used to specify the field's corresponding database column. If the column option is not specified, the name of the field under validation will be used.
     * Occasionally, you may need to set a custom connection for database queries made by the Validator. To accomplish this, you may prepend the connection name to the table name.
     */
    public function unique(string $source, ?string $column = null, ?string $idExcept = null, ?string $idColumn = null, ?string $dbConnection = null)
    {
        $rule = "unique:";

        $rule .= null === $dbConnection ? $source : "$dbConnection.$source";

        if ($column !== null) {
            $rule .= ",$column";
        }
        if ($idExcept !== null) {
            $rule .= ",$idExcept";
        }
        if ($idColumn !== null) {
            $rule .= ",$idColumn";
        }

        $this->rules[] = $rule;

        return $this;
    }

    /**
     * The field under validation must be a valid URL.
     */
    public function url()
    {
        $this->rules[] = 'url';

        return $this;
    }

    /**
     * The field under validation must be a valid RFC 4122 (version 1, 3, 4, or 5) universally unique identifier (UUID).
     */
    public function uuid()
    {
        $this->rules[] = 'uuid';

        return $this;
    }
}
