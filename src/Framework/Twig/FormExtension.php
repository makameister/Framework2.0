<?php
namespace Framework\Twig;

class FormExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('field', [$this, 'field'], [
                'is_safe' => ['html'],
                'needs_context' => true
            ])
        ];
    }

    /**
     * Renvoie un champs de formulaire (Boostrap 4)
     * @param array $context
     * @param string $key
     * @param mixed $value
     * @param string $label
     * @param array $options
     * @return string
     */
    public function field(array $context, string $key, $value, ?string $label = null, array $options = [])
    {
        $value = $this->convertValue($value);
        $type = $options['type'] ?? 'input';
        $attributes = [
            'class' => 'form-control ' . ($options['class'] ?? ''),
            'id' => $key,
            'name' => $key
        ];
        $class = 'form-group';
        $error = $this->getErrorHTML($context, $key);
        if ($error) {
            $class .= ' has-danger';
            $attributes['class'] .= ' is-invalid';

        }
        if ($type === 'textarea') {
            $input = $this->textarea($value, $attributes);
        } else {
            $input = $this->input($value, $attributes);
        }
        return "<div class=\"". $class ."\">
                    <label for=\"{$key}\">{$label}</label>
                    {$input}
                    {$error}
                </div>";
    }

    /**
     * Renvoie un input text
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    private function input(?string $value, array $attributes): string
    {
        return "<input type=\"text\" " . $this->getHtmlFromArray($attributes) . " value=\"{$value}\">";
    }

    /**
     * Renvoie un textarea
     * @param string|null $value
     * @param array $attributes
     * @return string
     */
    private function textarea(?string $value, array $attributes): string
    {
        return "<textarea " . $this->getHtmlFromArray($attributes) . ">{$value}</textarea>";
    }

    /**
     * Renvoie le libellé de l'erreur en format html
     * @param $context
     * @param $key
     * @return string
     */
    private function getErrorHTML($context, $key): string
    {
        $error = $context['errors'][$key] ?? false;
        if ($error) {
            return "<small class=\"form-text text-muted\">{$error}</small>";
        }
        return "";
    }

    /**
     * Renvoie le tableau des classes css formatées en html
     * @param array $attributes
     * @return string
     */
    private function getHtmlFromArray(array $attributes): string
    {
        return implode(' ', array_map(function ($key, $value) {
            return "$key=\"$value\"";
        }, array_keys($attributes), $attributes));
    }

    private function convertValue($value): string
    {
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d H:i:s');
        }
        return (string)$value;
    }
}
