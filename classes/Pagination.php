<?php
namespace Classes;

class Pagination{
    public $current_page;
    public $registers_per_page;
    public $total_registers;

    public function __construct($current_page = 1, $registers_per_page = 10, $total_registers = 0){
        $this->current_page = (int) $current_page;
        $this->registers_per_page = (int) $registers_per_page;
        $this->total_registers = (int) $total_registers;
    }

    public function offset(){
        return $this->registers_per_page * ($this->current_page - 1);
    }

    public function totalPages(){
        return ceil($this->total_registers / $this->registers_per_page);
    }

    public function previousPage(){
        $previous = $this->current_page - 1;
        return ($previous > 0) ? $previous : false;
    }

    public function nextPage(){
        $next = $this->current_page + 1;
        return ($next <= $this->totalPages()) ? $next : false;
    }

    public function nextLink(){
        $html = '';
        if($this->nextPage()){
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->nextPage()}\"> Next &raquo; </a>";
        }
        return $html;
    }

    public function previousLink(){
        $html = '';
        if($this->previousPage()){
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->previousPage()}\"> &laquo; Previous </a>";
        }
        return $html;
    }

    public function pageNumbers(){
        $html = '';
        for($i=1; $i <= $this->totalPages(); $i++){
            if($i === $this->current_page){
                $html .= "<span class=\"pagination__link pagination__link--current\"> {$i} </span>";
            }else{
                $html .= "<a class=\"pagination__link pagination__link--number\" href=\"?page={$i}\"> {$i} </a>";
            }
        }

        return $html;
    }

    public function pagination(){
        $html = '';
        if($this->total_registers > 1){
            $html .= "<div class=\"pagination\">";
            $html .= $this->previousLink();
            $html .= $this->pageNumbers();
            $html .= $this->nextLink();
            $html .= "</div>";
        }
        return $html;
    }
}