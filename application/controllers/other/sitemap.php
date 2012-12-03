<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-12-3
 * Time: 下午8:22
 * To change this template use File | Settings | File Templates.
 */
class sitemap extends MY_Controller
{
    public function baidu()
    {
        $this->load->model('product/Model_Product', 'product');
        $pData = $this->product->getProductList(100000, 0, 'pid');

        $baiDuXml = $this->load->view('other/sitemap_xml/baidu', array('data' => $pData), true);

        file_put_contents(FCPATH.'sitemap.xml', $baiDuXml);
    }
}
