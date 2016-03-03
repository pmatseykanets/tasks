<?php

if (!function_exists('form_select')) {
    /**
     * Render HTML <select>.
     *
     * @param $name
     * @param array $list
     * @param null  $selected
     * @param array $options
     * @param array $disabled
     *
     * @return string
     */
    function form_select($name, $list = [], $selected = null, $options = [], $disabled = [])
    {
        $html = '<select name="'.$name.'"';

        foreach ($options as $attribute => $value) {
            $html .= ' '.$attribute.'="'.$value.'"';
        }
        $html .= '">';

        if (is_null($selected)) {
            $selected = [];
        } elseif (!is_array($selected)) {
            $selected = [$selected];
        }

        foreach ($list as $value => $text) {
            $html .= '<option value="'.$value.'"';
            $html .= in_array($value, $selected) ? ' selected="selected"' : '';
            $html .= in_array($value, $disabled) ? ' disabled="disabled"' : '';
            $html .= '>'.$text.'</option>';
        }

        $html .= '</select>';

        return $html;
    }
}

if (!function_exists('flash')) {
    /**
     * Sets or gets an application status message.
     *
     * @param string|null $message
     * @param string      $type
     * @param bool        $instant Instant (same request) flash message
     *
     * @return array
     */
    function flash($message = null, $type = 'success', $instant = false)
    {
        if (is_null($message)) {
            if (!session()->has('status')) {
                return [];
            }

            $status = new stdClass();
            $status->message = session()->get('status');
            $status->type = session()->get('status_type') ?: 'success';

            if (session()->has('status_instant') && session()->get('status_instant') == true) {
                session()->forget(['status', 'status_type', 'status_instant']);
            }

            return [$status];
        }

        if ($instant) {
            session()->put('status', $message);
            session()->put('status_type', $type);
            session()->put('status_instant', true);
        } else {
            session()->flash('status', $message);
            session()->flash('status_type', $type);
        }
    }
}

if (!function_exists('render_markdown')) {
    /**
     * @param $markdown
     * @param array $config
     *
     * @return string
     */
    function render_markdown($markdown, $config = [])
    {
        // Obtain a pre-configured Environment with all the CommonMark parsers/renderers ready-to-go
        $environment = \League\CommonMark\Environment::createCommonMarkEnvironment();

        // Optional: Add your own parsers, renderers, extensions, etc. (if desired)
        // For example:  $environment->addInlineParser(new TwitterHandleParser());

        // Define your configuration:
        $config = array_merge(['safe' => true], $config);

        // Create the converter
        $converter = new \League\CommonMark\CommonMarkConverter($config, $environment);

        return $converter->convertToHtml($markdown);
    }
}
