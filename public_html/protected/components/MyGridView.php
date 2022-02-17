<?php
Yii::import('zii.widgets.grid.CGridView');
class MyGridView extends CGridView
{

    public function renderPager()
    {
        if(!$this->enablePagination)
            return;

        $pager=array();
        $class='CLinkPager';
        if(is_string($this->pager))
            $class=$this->pager;
        elseif(is_array($this->pager))
        {
            $pager=$this->pager;
            if(isset($pager['class']))
            {
                $class=$pager['class'];
                unset($pager['class']);
            }
        }
        $pager['pages']=$this->dataProvider->getPagination();

        if($pager['pages']->getPageCount()>1)
        {
            echo '<nav aria-label="Page navigation" class="'.$this->pagerCssClass.'">';
            $this->widget($class,$pager);
            echo '</nav>';
        }
        else
            $this->widget($class,$pager);
    }

    public function renderTableHeader()
    {
        if(!$this->hideHeader)
        {
            echo "<thead class='thead-dark'>\n";

            if($this->filterPosition===self::FILTER_POS_HEADER)
                $this->renderFilter();

            echo "<tr>\n";
            foreach($this->columns as $column)
                $column->renderHeaderCell();
            echo "</tr>\n";;

            if($this->filterPosition===self::FILTER_POS_BODY)
                $this->renderFilter();

            echo "</thead>\n";
        }
        elseif($this->filter!==null && ($this->filterPosition===self::FILTER_POS_HEADER || $this->filterPosition===self::FILTER_POS_BODY))
        {
            echo "<thead>\n";
            $this->renderFilter();
            echo "</thead>\n";
        }
    }



}