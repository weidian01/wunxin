<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-10-11
 * Time: 上午10:21
 * To change this template use File | Settings | File Templates.
 */
class color extends MY_Controller
{
    function index()
    {
        $color_id = $this->input->get('color_id');
        $pageno = max((int)$this->uri->rsegment(3, 1), 1);

        if(!$color_id)
        {
            $where = "color_id = 0";
        }
        else
        {
            $where  = "color_id != 0" ;
        }

        $this->load->model('product/Model_Product', 'product');
        $num = $this->product->getProductCount($where);

        $products = array();
        $pageHTML = '';
        $pageNUM = 1;
        if ($num) {
            $pagesize = 50;
            $pageNUM = ceil($num / $pagesize);
            $pageno = $pageno > $pageNUM ? $pageNUM:$pageno;
            $config['base_url'] = "/tmp/color/index";
            //$param && $config['suffix'] = '/' . $query;
            $config['total_rows'] = $num;
            $config['per_page'] = $pagesize;
            $config['use_page_numbers'] = TRUE;
            $config['uri_segment'] = 4;
            $config['num_links'] = 4;
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';
            $config['prev_link'] = '上一页';
            $config['next_link'] = '下一页';
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $pageHTML = $this->pagination->create_links();
            $offset = ($pageno - 1) * $pagesize;
            $products = $this->product->getProductList($pagesize, $offset, "pid, color_id, pname, market_price, sell_price,product_taobao_addr", $where);
        }

        $this->load->model('product/Model_Product_Color', 'color');
        $color = $this->color->getList(500, 0, array('color_id'=>'*'));
        foreach($color as $k=>$item)
        {
            if($item['parent_id'] != 0)
            {
                $color[$item['parent_id']]['children'][] = $item;
                unset($color[$k]);
            }
        }

        $this->view($products, $pageHTML, $color);
    }

    function view($products, $pagehtml, $color)
    {
        echo '<a href="?color_id=0">无颜色</a> /',' <a href="?color_id=1">有颜色</a><br>';
        echo $pagehtml;
        echo '<table border="1" width="100%">';
        echo '<tr>
        <th width="10%">ID</th>
        <th width="10%">COLOR_ID</th>
        <th width="30%">名称</th>
        <th width="5%">市场价</th>
        <th width="5%">售价</th>
        <th width="10%">图片</th>
        <th width="30%">操作</th></tr>';
        foreach ($products as $p) {
            echo  '<tr>';
            echo  '<td>',$p['pid'],'</td>';
            echo  '<td>',$p['color_id'] ? $p['color_id']:'null' ,'</td>';
            echo  '<td>','<a href="',$p['product_taobao_addr'],'" target="_blank">',$p['pname'],'</a>','</td>';
            echo  '<td>',fPrice($p['market_price']),'</td>';
            echo  '<td>',fPrice($p['sell_price']),'</td>';
            echo  '<td style="width:200px">',"<img src=\"",config_item('static_url'),'upload/product/',intToPath($p['pid']),'default.jpg" alt="',$p['pname'],'" width="164" height="220"/>','</td>';
            echo  '<td>';
                echo '<select name="color_id" onchange="set_color(',$p['pid'],', this.value)">';
                echo '<option value="0">选择产品色系</option>';
                foreach ($color as $item):
                echo '<optgroup label="',$item['china_name'],'" >';
                    if(isset($item['children'])):
                        foreach ($item['children'] as $v):
                            echo '<option style="background-color:#',$v['code'],';" value="',$v['color_id'],'"';
                                if(isset($p['color_id']) && $p['color_id']==$v['color_id'] ):
                                    echo 'selected="selected"';
                                endif;
                                echo '>',$v['china_name'],$v['english_name'];
                                echo '</option>';
                        endforeach;
                    endif;
                echo '</optgroup>';
                endforeach;
                echo '</select>';
            echo '</td>';
            echo "</tr>\n";
        }

        echo '</table>';
        echo $pagehtml;
        echo '<SCRIPT type=text/javascript src="http://wunxin.com/scripts/jquery.js"></SCRIPT>';
echo <<< END
<script>
function set_color(pid, cid)
{
    $.get("/tmp/color/set", { 'pid': pid, 'cid': cid },
      function(data){
        alert("Data Loaded: " + data);
    });
}
</script>
END;

    }

    function set()
    {
        $pid = $this->input->get('pid');
        $cid = $this->input->get('cid');
        $this->load->database();
        $this->db->where('pid', $pid);
        $this->db->update('product',array('color_id'=>$cid));
        echo  $pid,'-', $cid;
    }
}
