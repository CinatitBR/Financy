<?php
class Core {
  public function start($get_url) {
    $page = ucfirst($get_url['page'] . 'Controller');

    echo $page;

  }
}