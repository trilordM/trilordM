<tr>
    <th>Service Request Date</th>
    <th>Description</th>
    <th>Created Date</th>
    <th>Service Seeker</th>
</tr>
<?php
    $i = 0;
    if(count($getServiceRequest)>0){
        foreach($getServiceRequest as $request):
            $i++;
?>
            <tr>
                <td><?php echo $request['seeker_provider_requests']['requested_date']?></td>
                <td><?php echo $request['seeker_provider_requests']['description']?></td>
                <td><?php echo $request['seeker_provider_requests']['created_date']?></td>
                <td><?php echo $this->SmartForm->getUserInfo($request['seeker_provider_requests']['service_seeker_id'])?></td>
            </tr>
<?php
        endforeach;


    }else{
        echo 'No new Service Requests.';
    }
?>