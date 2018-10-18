<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class SSML
 * @package CodeCommerce\AlexaApi\Model
 */
class SSML
{
    const AMAZON_EFFECT_WHISPER = 'whispered';

    const BREAK_STRENGTH_NONE = 'none';
    const BREAK_STRENGTH_EXTRA_WEEK = 'x-weak';
    const BREAK_STRENGTH_WEEK = 'weak';
    const BREAK_STRENGTH_MEDIUM = 'medium';
    const BREAK_STRENGTH_STRONG = 'strong';
    const BREAK_STRENGTH_EXTRA_STRONG = 'x-strong';

    const EMPHASIS_LEVEL_STRONG = 'strong';
    const EMPHASIS_LEVEL_MODERATE = 'moderate';
    const EMPHASIS_LEVEL_REDUCED = 'reduced';

    const INTERPRET_AS_CHARACTERS = 'characters';
    const INTERPRET_AS_SPELL_OUT = 'spell-out';
    const INTERPRET_AS_CARDINAL = 'cardinal';
    const INTERPRET_AS_NUMBER = 'number';
    const INTERPRET_AS_ORDINAL = 'ordinal';
    const INTERPRET_AS_FRACTION = 'fraction';
    const INTERPRET_AS_UNIT = 'unit';
    const INTERPRET_AS_DIGITS = 'digits';
    const INTERPRET_AS_DATE = 'date';
    const INTERPRET_AS_TIME = 'time';
    const INTERPRET_AS_TELEPHONE = 'telephone';
    const INTERPRET_AS_ADDRESS = 'address';
    const INTERPRET_AS_INTERJECTION = 'interjection';
    const INTERPRET_AS_EXPLETIVE = 'expletive';

    const DATEFORMAT_MONTH_DAY_YEAR = 'mdy';
    const DATEFORMAT_DAY_MONTH_YEAR = 'dmy';
    const DATEFORMAT_YEAR_MONTH_DAY = 'ymd';
    const DATEFORMAT_MONTH_DAY = 'md';
    const DATEFORMAT_DAY_MONTH = 'dm';
    const DATEFORMAT_YEAR_MONTH = 'ym';
    const DATEFORMAT_MONTH_YEAR = 'my';
    const DATEFORMAT_DAY = 'd';
    const DATEFORMAT_MONTH = 'm';
    const DATEFORMAT_YEAR = 'y';

    /**
     * @var array
     */
    protected $output = [];

    /**
     * @return string
     */
    public function getText()
    {
        return "<speak>" . implode(" " . $this->output) . "</speak>";
    }

    /**
     * @param $output
     */
    protected function addOutput($output)
    {
        $this->output[] = $output;
    }

    /**
     * @param $outputtext
     * @param $type
     * @return $this
     */
    public function addAmazonEffect($outputtext, $type)
    {
        $ssml = "<amazon:effect name='" . $type . "'>";
        $ssml .= $outputtext;
        $ssml .= "</amazon:effect>";
        $this->addOutput($ssml);

        return $this;
    }

    /**
     * @param $text
     */
    public function addWhisper($text)
    {
        $this->addAmazonEffect($text, self::AMAZON_EFFECT_WHISPER);
    }

    /**
     * @param $sUrl
     * @return $this
     */
    public function addAudio($sUrl)
    {
        $output = "<audio src='" . $sUrl . "'>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param        $number
     * @param string $unit
     * @return $this
     */
    public function addTimeBreak($number, $unit = "s")
    {
        $output = "<break time='" . $number . $unit . "'>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param string $strength
     * @return $this
     */
    public function addBreak($strength = self::BREAK_STRENGTH_NONE)
    {
        $output = "<break strength='" . $strength . "'>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param        $text
     * @param string $level
     * @return $this
     */
    public function addEmphasis($text, $level = self::EMPHASIS_LEVEL_MODERATE)
    {
        $output = "<emphasis level='" . $level . "'>";
        $output .= $text;
        $output .= "</emphasis>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function addParagraph($text)
    {
        $output = "<p>";
        $output .= $text;
        $output .= "</p>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function addSentence($text)
    {
        $output = "<s>";
        $output .= $text;
        $output .= "</s>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param $text
     * @param $alias
     * @return $this
     */
    public function addAlias($text, $alias)
    {
        $output = "<sub alias='" . $alias . "'>";
        $output .= $text;
        $output .= "</sub>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param $text
     */
    public function addText($text)
    {
        $this->addOutput($text);
    }

    /**
     * @param      $text
     * @param      $interpretAs
     * @param null $format
     * @return $this
     */
    public function addTextAs($text, $interpretAs, $format = null)
    {
        $output = "<say-as interpret-as='" . $interpretAs . "'";

        if (null !== $format) {
            $output .= " format='" . $format . "'";
        }

        $output .= ">";
        $output .= $text;
        $output .= "</say-as>";
        $this->addOutput($output);

        return $this;
    }

    /**
     * @param        $date
     * @param string $format
     * @return $this
     */
    public function addDate($date, $format = self::DATEFORMAT_DAY_MONTH_YEAR)
    {
        $this->addTextAs($date, self::INTERPRET_AS_DATE, $format);

        return $this;
    }

    /**
     * @param $phone
     * @return $this
     */
    public function addTelephoneNumer($phone)
    {
        $this->addTextAs($phone, self::INTERPRET_AS_TELEPHONE);

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function addNumber($number)
    {
        $this->addTextAs($number, self::INTERPRET_AS_NUMBER);

        return $this;
    }
}
