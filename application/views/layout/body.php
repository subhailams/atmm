<?php
$this->layoutfolder = $this->config->item("layoutfolder");
$this->load->view($this->layoutfolder . "/header");
$this->load->view($this->layoutfolder . "/nav");
$this->load->view(strtolower($this->router->fetch_class()) . "/" . strtolower($this->router->fetch_method()) . "/" . $this->render);
$this->load->view($this->layoutfolder . "/footer");
$this->load->view($this->layoutfolder . "/right");
$this->load->view($this->layoutfolder . "/scriptfooter");
