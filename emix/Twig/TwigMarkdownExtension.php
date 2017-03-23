<?php
namespace Emix\Twig;


use Emix\markdown\MarkdownInterface;
use Twig_Extension;

class TwigMarkdownExtension extends Twig_Extension
{
    /**
     * @var MarkdownInterface
     */
    private $markdown;

    public function __construct (MarkdownInterface $markdown) {
        $this->markdown = $markdown;
    }

    public function getFilters () {
        return [
            new \Twig_SimpleFilter('markdownToHtml', [$this->markdown, 'markdownToHtml'], ['is_safe' => ['html']])
        ];
    }

    public function getFunctions () {
        return [
            new \Twig_SimpleFunction('markdownToHtml', [$this->markdown, 'markdownToHtml'], ['is_safe' => ['html']])
        ];
    }
}
