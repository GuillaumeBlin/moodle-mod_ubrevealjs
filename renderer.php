<?php

class ubrevealjs_data implements renderable {
    public $title;
    public $json; 
    public function __construct(stdclass $ubrevealjs, $anonymous = false, array $attachments = null) {
	$this->title=$ubrevealjs->name;
	$this->reveal_div_content=$ubrevealjs->reveal_div_content;
    }
}
 
class mod_ubrevealjs_renderer extends plugin_renderer_base {
 
    protected function render_ubrevealjs_data(ubrevealjs_data $data) {
        $out  = $this->output->heading(format_string($data->title), 2);
	$out .=  $this->output->container_start('reveal');
	$out .= $data->reveal_div_content;
	$out .= $this->output->container_end();
        return $this->output->container($out, 'ubrevealjs');
    }
}
 
