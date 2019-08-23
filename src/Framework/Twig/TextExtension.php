<?php

namespace Framework\Twig;

/**
 * Extension concernant les texts
 * Class TextExtension
 * @package Framework\Twig
 */
class TextExtension extends \Twig_Extension
{
    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('excerpt', [$this, 'excerpt'])
        ];
    }

    /**
     * Renvoie un extrait du contenu
     *
     * @param string $content
     * @param int $maxLenght
     * @return string
     */
    public function excerpt(?string $content, int $maxLenght = 100): string
    {
        if (is_null($content)) {
            return '';
        }
        if (mb_strlen($content) > $maxLenght) {
            $excerpt = mb_substr($content, 0, $maxLenght);
            $lastSpace = mb_strrpos($excerpt, ' ');
            return mb_substr($excerpt, 0, $lastSpace) . '...';
        }
        return $content;
    }
}
