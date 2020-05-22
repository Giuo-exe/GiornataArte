<?php

  class eventi{
    private $id=0;
    private $tema="";
    private $luogo="";
    private $professori="";
    private $giorno="";
    private $ora="";
    private $foto="";

    public function __construct($id,$tema,$luogo,$professori,$giorno,$ora,$foto){
      $this->id=$id;
      $this->tema=$tema;
      $this->luogo=$luogo;
      $this->professori=$professori;
      $this->giorno=$giorno;
      $this->ora=$ora;
      $this->foto=$foto;
    }

    function getId(){
      return $this->id;
    }

    function getTema(){
      return $this->tema;
    }

    function getLuogo(){
      return $this->luogo;
    }

    function getProfessori(){
      return $this->professori;
    }

    function getGiorno(){
      return $this->giorno;
    }

    function getOra(){
      return $this->ora;
    }

    function getFoto(){
      return $this->foto;
    }
  }



?>
