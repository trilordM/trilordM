<div class="users view service-provider-profile-container">

    <div class="title-container"><!-- start main page title -->
        <div class="container">
            <div class="page-title">User > Edit</div>
        </div>
    </div><!-- end .title-container -->

    <div class="content-container">
        <?php echo $this->Session->flash(); ?>

        <dl>
            <dt><?php echo __('Image'); ?></dt>
             <dd>
             <?php echo $this->Html->image('/providers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'no picture'));?>
            <td class="actions">
            <?php echo $this->Html->link(__('Edit photo'), array('action' => 'provider_pic_edit', $user['User']['id']),array('class'=>'btn btn-default btn-green btn-sm')); ?>
            <td class="actions">
            </dd>

            <dt><?php echo __('Name'); ?></dt>
            <dd>
                <?php echo h($user['User']['name']); ?>
                &nbsp;
            </dd>

            <dt><?php echo __('Email'); ?></dt>
            <dd>
                <?php echo h($user['User']['email']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Username'); ?></dt>
            <dd>
                <?php echo h($user['User']['username']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Phone'); ?></dt>
            <dd>
                <?php echo h($user['User']['phone']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Dob'); ?></dt>
            <dd>
                <?php echo h($user['User']['dob']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Permanent Address'); ?></dt>
            <dd>
                <?php echo h($user['User']['permanent_address']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Temporary Address'); ?></dt>
            <dd>
                <?php echo h($user['User']['temporary_address']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Expertise Level'); ?></dt>
            <dd>
                <?php echo h($user['User']['expertise_level']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('About Me'); ?></dt>
            <dd>
                <?php echo h($user['User']['about_me']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Rate'); ?></dt>
            <dd>
                <?php
                $i =0;
                foreach($ratePackages as $rate):
                    $i++;
                    echo $rate['RP']['title'];
                    echo ' : Rs '.$rate['SPR']['rate'].'<br>';
                    //echo $this->Form->hidden('rate_id_'.$i, array('value'=>$rate['RP']['id']));
                endforeach;
            //count $ratePackages
            echo $this->Form->hidden('rate_count',array('value'=>count($ratePackages)));
             ?>
                &nbsp;
            </dd>
            <dt><?php echo __('ServiceCategory'); ?></dt>
            <dd>
                <?php
                $i =0;
                foreach($serviceCategories as $category):
                    $i++;
                echo $category['service_categories']['title'].'<br>';
                endforeach;
             ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Documents'); ?></dt>
            <dd>
                <?php
                foreach($user['ServiceProviderDocument'] as $document):

                echo $document['title'].'</br>';
                echo $this->Html->image('/providers_document/'.$document['document_file'],array('width'=>140,'height'=>'100','alt'=>'No Image')).'&nbsp;'.'</br>';

                endforeach;
             ?>
                &nbsp;
            </dd>

        </dl>

        <?php echo $this->Html->link(__('Edit Profile'), array('action' => 'provider_edit', $user['User']['id']),array('class'=>'btn btn-default btn-green btn-sm')); ?>
        <?php echo $this->Html->link(__('Change password'), array('action' => 'change_password'),array('class'=>'btn btn-default btn-green btn-sm')); ?>
    </div>
</div>

