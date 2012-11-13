<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-11-12
 * Time: 下午6:44
 * To change this template use File | Settings | File Templates.
 */
class advert extends MY_Controller
{
    public function getAdvert()
    {
        $positionId = $this->input->get_post('position_id');

        if (empty ($positionId)) {
            return;
        }
        $this->load->model('/business/Model_Ad_Position', 'position');
        $positionData = $this->position->getPositionByPid($positionId);
        //p($positionData);
        if (empty ($positionData)) {
            return ;
        }
        $viewNum = empty ($positionData['view_num']) ? 1 : $positionData['view_num'];
//echo $viewNum;
        $where = array(
            'start_time <=' => date('Y-m-d H:i:s', TIMESTAMP),
            'end_time >=' => date('Y-m-d H:i:s', TIMESTAMP),
            'status' => '1',
        );
        $this->load->model('/business/Model_Ad', 'ad');
        $advertData = $this->ad->getAdvertByPositionId($positionId, $viewNum, 0, '*', $where, 'sort desc');

        if (empty ($advertData)) {
            return ;
        }

        $positionData['advert'] = $advertData;

        //p($positionData);
        $this->json_output($positionData);
    }
}
