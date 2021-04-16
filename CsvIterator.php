<?php

//Iterator draft
class CsvIterator implements Iterator
{
    const ROW_SIZE=4096;

    private $filePointer=null;

    private $currentElement=null;

    private $rowCounter=null;

    private $delimiter=null;


    public function __construct($file,$delimiter=','){
        try{
            $this->filePointer=fopen($file,'rb');
            $this->delimiter=$delimiter;
        }catch (\Exception $e){
            throw new \Exception('The file "' . $file . '" cannot be read.');
        }
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        $this->currentElement=fgetcsv($this->filePointer,self::ROW_SIZE,$this->delimiter);
        $this->rowCounter++;
        return $this->currentElement;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        if(is_resource($this->filePointer)){
            return !feof($this->filePointer);
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->rowCounter;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        if(!$this->next()){
            if(is_resource($this->filePointer)){
                fclose($this->filePointer);
            }
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->rowCounter=0;
        rewind($this->filePointer);
    }
}