<?php
$this->layoutfolder = $this->config->item("layoutfolder");
$this->load->view($this->layoutfolder . "/header");
$this->load->view($this->layoutfolder . "/nav");
$FunctionS = array("assessmentforms", "pdfreport");
if (in_array(strtolower($this->router->fetch_method()), $FunctionS)):
    $this->load->view(strtolower($this->router->fetch_method()) . "/" . $this->render);
else:
    $this->load->view(strtolower($this->router->fetch_class()) . "/" . strtolower($this->router->fetch_method()) . "/" . $this->render);
endif;
$this->load->view($this->layoutfolder . "/footer");
$this->load->view($this->layoutfolder . "/right");
$this->load->view($this->layoutfolder . "/scriptfooter");
