<?php

namespace App\Component\Datatable;

use App\Customer;

class DataTable
{
    
    public $id;
    public $config = array();
    public $data = array('column' => array(), 'row' => array());
    public $base_model = "";
    public $base_table = "";
    public $callback = "";
    public $action_single = "";
    public $action_bulk = "";


    public function __construct($id = 'datatable1', $spesification = array())
    {
        $this->initialConfig($id);
        if(is_array($spesification))
        {
            if(array_key_exists('column',$spesification)) $this->setColumn($spesification['column']);
            if(array_key_exists('base_model',$spesification)) $this->setBaseModel($spesification['base_model']);
            if(array_key_exists('base_table',$spesification)) $this->setBaseTable($spesification['base_table']);
            if(array_key_exists('callback',$spesification)) $this->setCallback($spesification['callback']);
            if(array_key_exists('action_single',$spesification)) $this->setActionSingle($spesification['action_single']);
            if(array_key_exists('action_bulk',$spesification)) $this->setActionBulk($spesification['action_bulk']);
        }
    }

    
    private function initialConfig($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Datatable ID
        |--------------------------------------------------------------------------
        |
        | This value can specified by user
        */
        $this->id = $id;

        /*
        |--------------------------------------------------------------------------
        | Datatable Paging Feature
        |--------------------------------------------------------------------------
        |
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['paging'] = true;

        /*
        |--------------------------------------------------------------------------
        | Current Page Number of Data List 
        |--------------------------------------------------------------------------
        |
        | This value must be integer.
        */
        $this->config['current_page'] = 1;

        /*
        |--------------------------------------------------------------------------
        | Total Page View 
        |--------------------------------------------------------------------------
        |
        */
        $this->config['total_pages'] = 1;
        
        /*
        |--------------------------------------------------------------------------
        | Datatable View per Page Feature
        |--------------------------------------------------------------------------
        |
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['view_per_page'] = true;

        /*
        |--------------------------------------------------------------------------
        | Set List of Datatable View per Page
        |--------------------------------------------------------------------------
        |
        | Determine Number of Data can Shown in Datatable. This values must be array of integer
        */
        $this->config['view_per_page_list'] = array(20,50,100,200);

        /*
        |--------------------------------------------------------------------------
        | Determine Current Number of Data Shown in Datatable
        |--------------------------------------------------------------------------
        |
        | This value depend on $this->config['view_per_page_list']. 
        | Default is first value of list.
        */
        $this->config['current_view_per_page'] = $this->config['view_per_page_list'][0];

        /*
        |--------------------------------------------------------------------------
        | Datatable Export to Document config
        |--------------------------------------------------------------------------
        |
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['export'] = false;

        /*
        |--------------------------------------------------------------------------
        | Set List of Datatable Export to Document config
        |--------------------------------------------------------------------------
        |
        | Data can export to CSV, Excel XML, and PDF only. Set this values as array.
        */
        $this->config['export_list'] = array('csv','excel','pdf');

        /*
        |--------------------------------------------------------------------------
        | Datatable Bulk Action Feature
        |--------------------------------------------------------------------------
        |
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['bulk'] = true;

        /*
        |--------------------------------------------------------------------------
        | Datatable Search Feature
        |--------------------------------------------------------------------------
        |
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['filter'] = true;

        /*
        |--------------------------------------------------------------------------
        | Datatable Column Sort Feature
        |--------------------------------------------------------------------------
        |
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['sorting'] = true;

        /*
        |--------------------------------------------------------------------------
        | Datatable Column Order
        |--------------------------------------------------------------------------
        |
        | Determine how data ordered. Order data list based on choosen column.
        | The ordered column specify in datatable column definision.
        | Example :
        |   $this->config['order_by'] = array('id', 'asc');
        |   $this->config['order_by'] = array('updated_date', 'desc');
        */
        $this->config['order_by'] = array();

        /*
        |--------------------------------------------------------------------------
        | Datatable Action Column
        |--------------------------------------------------------------------------
        |
        | Determine if the table have action column or not
        | TRUE : enable
        | FALSE : disable
        */
        $this->config['action_column'] = true;

        /*
        |--------------------------------------------------------------------------
        | Total Number of Data Initialition
        |--------------------------------------------------------------------------
        */
        $this->config['total_rows'] = 0;

        /*
        |--------------------------------------------------------------------------
        | Select All Items
        |--------------------------------------------------------------------------
        */
        $this->config['select_all'] = false;

        /*
        |--------------------------------------------------------------------------
        | Unselect All Items
        |--------------------------------------------------------------------------
        */
        $this->config['unselect_all'] = true;

        /*
        |--------------------------------------------------------------------------
        | Selected Items List
        |--------------------------------------------------------------------------
        |
        | The values are key of the data.
        */
        $this->config['selected_items'] = array();

        /*
        |--------------------------------------------------------------------------
        | Unselected Items List
        |--------------------------------------------------------------------------
        |
        | The values are key of the data.
        */
        $this->config['unselected_items'] = array();

        /*
        |--------------------------------------------------------------------------
        | Number of Selected Items
        |--------------------------------------------------------------------------
        |
        */
        $this->config['selected_items_num'] = 0;

        /*
        |--------------------------------------------------------------------------
        | Datatable Action List
        |--------------------------------------------------------------------------
        |
        | none : Initial state. Nothing to do.
        | change_page : Change data list page.
        | change_page_per_view : Change number of data shown.
        | export_csv : Export selected data to CSV document.
        | export_excel : Export selected data to Excel document.
        | export_pdf : Export selected data to PDF document.
        | enable : Enable selected data.
        | disable : Disable selected data.
        | delete : Delete selected data.
        | search : Search data based on filter fields.
        | clear : Reset data list and clear filter fields.
        | order : Order data list based on specific column.
        | 
        */
        $this->config['action'] = 'none';

    }


    public function config($config = array())
    {
        /*
        |--------------------------------------------------------------------------
        | Specify Datatable Feature
        |--------------------------------------------------------------------------
        |
        | Example:
        |   
        |   Disable datatable paging feature:
        |       $dt->config(['paging' => false]);
        |
        |   Disable view per page options:
        |       $dt->config(['view_per_page' => false]);
        |
        |   Disable document export feature:
        |       $dt->config(['export' => false]);
        |
        |   Disable bulk actions feature:
        |       $dt->config(['bulk' => false]);
        |
        |   Disable data filter feature:
        |       $dt->config(['filter' => false]);
        |
        |   Disable column order feature:
        |       $dt->config(['sorting' => false]);
        |
        |   Disable datatable action column:
        |       $dt->config(['action_column' => false]);
        */

        if(is_array($config) && count($config) > 0)
        {
            foreach($config as $key => $value)
            {   
                if(in_array($key,$this->config)) 
                {
                    $this->config[$key] = $value;
                    if($key == 'view_per_page_list')
                    {
                        $this->config['current_view_per_page'] = $this->config['view_per_page_list'][0];
                    }
                    
                }
            }
        }
    }


    public function params()
    {
        return htmlspecialchars(json_encode($this->config));
    }


    public function columns()
    {
        return $this->data['column'];
    }


    public function setColumn($column = array())
    {
        /*
        |--------------------------------------------------------------------------
        | Datatable Column Spesification
        |--------------------------------------------------------------------------
        |
        | Datatable column specified by an array.
        | Datatable column must be specified immediately after Datatable object initialized.
        |
        | There are 7 properties which can be used to define a Datatable column, i.e:
        |
        |   1. 'name'           : Used to specify column name. 
        |                         This propety is mandatory.
        |
        |   2. 'field'          : Database table field that related to the column. 
        |                         This propety is mandatory.
        |
        |   3. 'width'          : Specify Datatable column width. 
        |                         This propety is mandatory.
        |
        |   4. 'sorted'         : Data order direction. To setup data order direction, 
        |                         we can choose one of following options:
        |                           - none : Data not ordered by this column.
        |                           - asc  : Data sorted by this column in Ascending order.
        |                           - desc : Data sorted by this column in Descending order.
        |                         This property is mandatory if "Column Sort" feature is enable.
        |                        
        |   5. 'filter'         : Data filter type. 
        |                         Specify data type that used by this column when user using search function.
        |                         Use one of following options to determine filter type:
        |                           - none          : Data can't filtered by this column.
        |                           - text          : User can type some words to filter data using this column.
        |                           - number        : User can type a number to filter data using this column.
        |                           - number_range  : User can type 2 numbers (from...to) when filter data using this column.
        |                           - date          : User can choose a date to filter data using this column.
        |                           - date_range    : User can choose 2 dates (from...to) when filter data using this column.
        |                           - select        : User can select an option to filter data using this column.
        |                         This property is mandatory if "Datatable Search" feature is enable.
        |
        |   6. 'filter_select'  : Setup options list for 'select' filter property. Option spesified by an array.
        |                         This property is mandatory if 'filter' property is 'select'.
        |
        |   7. 'attr'           : Specifiy column attribute. Use one of following options to determine attribute type:
        |                           - none : This column doesn't have additional attribute.
        |                           - key  : The value of this column defined as a data key. 
        |                                    It's look like primary key on database table.
        |                                    So, all process of update & delete data in Datatable depend on this value.
        |                         'attr' => 'key' property must be exist in one of column definition.
        |    
        | Example Definition:
        |   [
        |       0 => [
        |               'name' => 'ID',
        |               'field' => 'id',
        |               'width' => '5%',
        |               'sorted' => 'asc',
        |               'filter' => 'number',
        |               'attr' => 'key',
        |       ],
        |       1 => [
        |               'name' => 'Name',
        |               'field' => 'name',
        |               'width' => '20%',
        |               'sorted' => 'none',
        |               'filter' => 'text',
        |       ],
        |       2 => [
        |               'name' => 'Status',
        |               'field' => 'active',
        |               'width' => '10%',
        |               'sorted' => 'none',
        |               'filter' => 'select',
        |               'filter_select' => ['1' => 'Active', '0' => 'Inactive'],
        |       ],
        |       ...
        |   ]
        */

        if(is_array($column) && count($column) > 0)
        {
            $this->data['column'] = $column;
            foreach($this->data['column'] as $c)
            {
                if(array_key_exists('sorted', $c) && $c['sorted'] != 'none') $this->config['order_by'] = array($c['field'] => $c['sorted']);
                if(in_array($c['filter'],array('number','text','date','select')))
                {
                    $this->config['search'][$c['field']]['type'] = $c['filter'];
                    $this->config['search'][$c['field']]['value'][0] = '';
                }
                else if(in_array($c['filter'],array('number_range','date_range')))
                {
                    $this->config['search'][$c['field']]['type'] = $c['filter'];
                    $this->config['search'][$c['field']]['value'][0] = '';
                    $this->config['search'][$c['field']]['value'][1] = '';
                }
            }
        }
    }

    
    public function setBaseModel($sql = "")
    {
        $this->base_model = $sql;
    }


    public function setBaseTable($table = "")
    {
        $this->base_table = $table;
    }


    public function setCallback($callback = "")
    {
        $this->callback = $callback;
    }


    public function setActionSingle($action = "")
    {
        $this->action_single = $action;
    }


    public function setActionBulk($action = "")
    {
        $this->action_bulk= $action;
    }


    public function fetch()
    {
        foreach($this->getData() as $i=>$d)
        {
            foreach($this->columns() as $column)
            {
                $this->data['row'][$i][$column['field']] = $d->{$column['field']};
            }
        }
    }


    public function fetchAjax($params = '')
    {
        if(is_array($params) && count($params) > 0)
        {
            $this->config = $params;
            
            if($this->config['action'] == 'enable') $this->updateData('enable');
            else if($this->config['action'] == 'disable') $this->updateData('disable');
            else if($this->config['action'] == 'delete') $this->updateData('delete');
            
            $this->fetch();
            return json_encode(array('datatable_params' => $this->config, 'data' => $this->data['row']));
        }
    }


    public function callbackAjax($params = '')
    {
        if(is_array($params) && count($params) > 0)
        {
            $this->config = $params;
            
            if($this->config['action'] == 'enable') $this->updateData('enable');
            else if($this->config['action'] == 'disable') $this->updateData('disable');
            else if($this->config['action'] == 'delete') $this->updateData('delete');
        }
    }


    public function getFilterQuery()
    {
        /*
        |--------------------------------------------------------------------------
        | Datatable Data Filtering
        |--------------------------------------------------------------------------
        |
        | Use "HAVING" instead of "WHERE" to get data from aliased column name.
        */
        $having = "";
        foreach($this->config['search'] as $field=>$v)
        {
            if($this->config['search'][$field]['type'] == 'text' && $this->config['search'][$field]['value'][0] != '')
            {
                $having .= ($having == "") ? " HAVING " : " AND ";
                $having .= " ".$field." LIKE '%".$this->config['search'][$field]['value'][0]."%' ";
            }
            else if($this->config['search'][$field]['type'] == 'number' && $this->config['search'][$field]['value'][0] != '')
            {
                $having .= ($having == "") ? " HAVING " : " AND ";
                $having .= " ".$field." = ".$this->config['search'][$field]['value'][0]." ";
            }
            else if($this->config['search'][$field]['type'] == 'number_range')
            {
                if($this->config['search'][$field]['value'][0] != '' && $this->config['search'][$field]['value'][1] != '')
                {   
                    $having .= ($having == "") ? " HAVING " : " AND ";
                    $having .= " ".$field." >= ".$this->config['search'][$field]['value'][0]." AND ".$field." <= ".$this->config['search'][$field]['value'][1]." ";
                }
                else if($this->config['search'][$field]['value'][0] != '')
                {
                    $having .= ($having == "") ? " HAVING " : " AND ";
                    $having .= " ".$field." >= ".$this->config['search'][$field]['value'][0]." ";
                }
                else if($this->config['search'][$field]['value'][1] != '')
                {
                    $having .= ($having == "") ? " HAVING " : " AND ";
                    $having .= " ".$field." <= ".$this->config['search'][$field]['value'][1]." ";
                }
            }
            else if($this->config['search'][$field]['type'] == 'date' && $this->config['search'][$field]['value'][0] != '')
            {
                $having .= ($having == "") ? " HAVING " : " AND ";
                $having .= " DATE(".$field.") = '".date_format(date_create($this->config['search'][$field]['value'][0]),'Y-m-d')."' ";
            }
            else if($this->config['search'][$field]['type'] == 'date_range')
            {
                if($this->config['search'][$field]['value'][0] != '' && $this->config['search'][$field]['value'][1] != '')
                {   
                    $having .= ($having == "") ? " HAVING " : " AND ";
                    $having .= " DATE(".$field.") >= '".date_format(date_create($this->config['search'][$field]['value'][0]),'Y-m-d')."' AND DATE(".$field.") <= '".date_format(date_create($this->config['search'][$field]['value'][1]),'Y-m-d')."' ";
                }
                else if($this->config['search'][$field]['value'][0] != '')
                {
                    $having .= ($having == "") ? " HAVING " : " AND ";
                    $having .= " DATE(".$field.") >= '".date_format(date_create($this->config['search'][$field]['value'][0]),'Y-m-d')."' ";
                }
                else if($this->config['search'][$field]['value'][1] != '')
                {
                    $having .= ($having == "") ? " HAVING " : " AND ";
                    $having .= " DATE(".$field.") <= '".date_format(date_create($this->config['search'][$field]['value'][1]),'Y-m-d')."' ";
                }
            }
            else if($this->config['search'][$field]['type'] == 'select' && $this->config['search'][$field]['value'][0] != '')
            {
                $having .= ($having == "") ? " HAVING " : " AND ";
                $having .= " ".$field." = '".$this->config['search'][$field]['value'][0]."' ";
            }
        }
        
        return $this->base_model.$having;
    }


    public function &getData()
    {
        return $this->execQuery($this->getFilterQuery());
    } 


    public function &execQuery($sql = "")
    {
        $order_by = "";
        if(count($this->config['order_by']) > 0) $order_by = " ORDER BY ".key($this->config['order_by'])." ".strtoupper($this->config['order_by'][key($this->config['order_by'])]);
        $limit = " LIMIT ".(($this->config['current_page'] - 1 ) * $this->config['current_view_per_page']).",".$this->config['current_view_per_page'];

        $total_rows = \DB::select( \DB::raw("SELECT COUNT(1) AS total_rows FROM (".$sql.") AS a"));
        $data = \DB::select( \DB::raw($sql.$order_by.$limit));

        $this->config['total_rows'] = $total_rows[0]->total_rows;
        $this->config['total_pages'] = ceil($this->config['total_rows'] / $this->config['current_view_per_page']);
        if($this->config['total_pages'] == 0) $this->config['total_pages'] = 1; 

        return $data;
    }


    public function updateData($action = 'enable')
    {
        
        $ids = $where = '';
        if($this->config['select_all'] == 'true')
        {
            if(count($this->config['unselected_items']) > 0)
            {
                foreach($this->config['unselected_items'] as $item) if($item != '') $ids .= "'".$item."',";
                $ids = rtrim($ids,',');
                if($ids != '') $where = "WHERE id NOT IN(".$ids.")";
            }
        }
        else
        {
            if(count($this->config['selected_items']) > 0)
            {
                foreach($this->config['selected_items'] as $item) if($item != '') $ids .= "'".$item."',";
                $ids = rtrim($ids,',');
                if($ids != '') $where = "WHERE id IN(".$ids.")";
            }
        }

        if($action == 'enable') \DB::statement("UPDATE ".$this->base_table." SET active = '1' ".$where);
        else if($action == 'disable') \DB::statement("UPDATE ".$this->base_table." SET active = '0' ".$where);
        else if($action == 'delete') \DB::statement("DELETE ".$this->base_table."  ".$where);
    }


    public function getSelectedItems()
    {
        $selected_items = array('flag' => 'in', 'items' => array());
        $ids = $where = '';
        if($this->config['select_all'] == 'true')
        {
            if(count($this->config['unselected_items']) > 0)
            {
                foreach($this->config['unselected_items'] as $item) if($item != '') $selected_items['items'][] = $item;
                $selected_items['flag'] = 'notin';
            }
        }
        else
        {
            if(count($this->config['selected_items']) > 0)
            {
                foreach($this->config['selected_items'] as $item) if($item != '') $selected_items['items'][] = $item;
            }
        }

        return $selected_items;
    }


    public function generate()
    {
        $dt = &$this;
        return view('backend.component.datatable.datatable', compact('dt'));
    }


}


