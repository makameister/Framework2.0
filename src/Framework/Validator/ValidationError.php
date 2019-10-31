<?php
namespace Framework\Validator;

class ValidationError
{
    private $key;

    private $rule;

    /**
     * @var array
     */
    private $attributes;

    private $messages = [
        'required' => 'Le champs %s est requis',
        'empty' => 'Le champs %s ne peut être vide',
        'slug' => 'Le slug %s n\'est pas valide',
        'minLength' => 'Le champs %s doit contenir plus de %d caractères',
        'maxLength' => 'Le champs %s doit contenir moins de %d caractères',
        'betweenLength' => 'Le champs %s doit contenir entre %d et %d caractères',
        'datetime' => 'Le champ %s doit être une date valide ($s)',
        'exists' => 'Le champs %s n\'existe pas sur dans la table %s',
        'unique' => 'L\'attribut %s doit être unique',
        'filetype' => 'Le champs %s n\'est pas au bon format (%s)',
        'uploaded' => 'Vous devez uploader un fichier'
    ];

    public function __construct(string $key, string $rule, array $attributes = [])
    {
        $this->key = $key;
        $this->rule = $rule;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        $params = array_merge([$this->messages[$this->rule], $this->key], $this->attributes);
        return (string)call_user_func_array('sprintf', $params);
    }
}
