<?php /* SVN: $Id: $ */ ?>
<div class="partitions index">
	<?php if(empty($this->request->params['isAjax'])) { ?>
		<h2 class="ver-space top-mspace text-32 sep-bot">		
			<?php echo __l('My Partitions');?>
		</h2> 
	<?php } ?>
	<div class="tabbable ver-space top-mspace">
		<div id="list" class="tab-pane active in no-mar">
			<div class="span24 clearfix">
				<div class="span12 pull-left">
				<?php 
				$class = (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) ? 'active' : null;
				echo $this->Html->link( '
					<dl class="dc list users '.$class .' mob-clr mob-sep-none ">					         	
						<dt class="pr hor-mspace text-11 grayc"  title="'.__l('Enabled').'">'.__l('Enabled').'</dt>
						<dd title="'.$this->Html->cInt($active,false).'" class="textb text-20 no-mar graydarkc pr hor-mspace">'.$this->Html->cInt($active ,false).'</dd>                  	
					</dl>'
					, array('action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false,'class'=>'no-under show pull-left mob-clr bot-space bot-mspace cur'));
				$class = (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) ? 'active' : null;
				echo $this->Html->link( '
					<dl class="dc list users '.$class .' mob-clr mob-sep-none ">					         	
						<dt class="pr hor-mspace text-11 grayc"  title="'.__l('Disabled').'">'.__l('Disabled').'</dt>
						<dd title="'.$this->Html->cInt($inactive,false).'" class="textb text-20 no-mar graydarkc pr hor-mspace">'.$this->Html->cInt($inactive ,false).'</dd>                  	
					</dl>'
					, array('action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false,'class'=>'no-under show pull-left mob-clr bot-space bot-mspace cur'));
				$class = (empty($this->request->params['named']['filter_id'])) ? 'active' : null;
				echo $this->Html->link( '
					<dl class="dc list users '.$class .' mob-clr mob-sep-none ">					         	
						<dt class="pr hor-mspace text-11 grayc"  title="'.__l('Total').'">'.__l('Total').'</dt>
						<dd title="'.$this->Html->cInt($active + $inactive,false).'" class="textb text-20 no-mar graydarkc pr hor-mspace">'.$this->Html->cInt($active + $inactive,false).'</dd>                  	
					</dl>'
					, array('action'=>'index'), array('escape' => false,'class'=>'no-under show pull-left mob-clr bot-space bot-mspace cur'));
				
				?>
				</div>
				<div class="span11 hor-space pull-right dc">
					<div class="pull-right top-space mob-clr dc top-mspace">
						<?php echo $this->Html->link('<span class="ver-smspace"><i class="icon-plus-sign no-pad top-smspace"></i></span>', array( 'action' => 'add'), array('escape' => false,'class' => 'add btn btn-primary textb text-18 whitec js-no-pjax','title'=>__l('Add'))); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo $this->element('paging_counter');?>
<?php
	echo $this->Form->create('Partition' , array('class' => 'normal','action' => 'update'));
	echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); 
?>
<div class="ver-space">
	<div id="active-users" class="tab-pane active in no-mar">
		<table class="table no-round table-striped">
		<thead>
			<tr class=" well no-mar no-pad">
				<th class="sep-right dc span2"><?php echo __l('Select'); ?></th>
				<th class="sep-right dc span2"><?php echo __l('Actions');?></th>
				<th class="dc sep-right"><?php echo $this->Paginator->sort( 'created',__l('Created'));?></th>
				<th class="sep-right dl"><?php echo $this->Paginator->sort('name',__l('Partition'));?></th>
				<th class="sep-right dl"><?php echo $this->Paginator->sort('Hall.name',__l('Hall'));?></th>
				<th class="sep-right dl"><?php echo $this->Paginator->sort('User.username',__l('User'));?></th>
				<th class="sep-right dc"><?php echo $this->Paginator->sort('custom_price_per_type_count',__l('Mapped'));?></th>
				<th class="sep-right dc"><?php echo $this->Paginator->sort('no_of_rows',__l('Rows'));?></th>
				<th class="sep-right dc"><?php echo $this->Paginator->sort('no_of_columns',__l('Columns'));?></th>
				<th class="sep-right dc"><?php echo $this->Paginator->sort('seat_count',__l('Seats'));?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($partitions)){
				$i = 0;
				foreach ($partitions as $partition){
					$class = null;
					$active_class = '';
					if ($i++ % 2 == 0) {
						$class = 'altrow';
					}
					if($partition['Partition']['is_active']){
						$status_class = 'js-checkbox-active';
					}else{
						$active_class = 'disable';
						$status_class = 'js-checkbox-inactive';
					}
			?>
					<tr class="<?php echo $class.' '.$active_class;?>">
						<td class="dc">
							<?php echo $this->Form->input('Partition.'.$partition['Partition']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$partition['Partition']['id'], 'label' => "", 'class' => $status_class.' js-checkbox-list')); ?>
						</td>
						<td class="dc">
							<span class="dropdown"> 
								<span title="<?php echo __l('Actions');?>" data-toggle="dropdown" class="graydarkc left-space hor-smspace icon-cog text-18 cur dropdown-toggle"> 
									<span class="hide"><?php echo __l('Actions');?></span> 
								</span>
								<ul class="dropdown-menu arrow no-mar dl">
									<li>
										<?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action' => 'edit', $partition['Partition']['id']), array('escape' => false,'class' => 'js-no-pjax', 'title' => __l('Edit')));?>
									</li>
									<li>
										<?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action' => 'delete', $partition['Partition']['id']), array('escape' => false,'class' => 'delete js-delete', 'title' => __l('Delete')));?>
									</li>
									<li>
										<?php echo $this->Html->link('<i class="icon-th"></i>'.__l('Preview'), array('action' => 'preview', $partition['Partition']['id']), array('escape' => false,'class' => 'js-no-pjax', 'title' => __l('Preview')));?>
									</li>
								</ul>
							</span>
						</td>
						<td class="dc"><?php echo $this->Html->cDateTime($partition['Partition']['created']);?></td>
						<td class="dl"><?php echo $this->Html->cText($partition['Partition']['name']);?></td>
						<td class="dl"><?php echo $this->Html->cText($partition['Hall']['name']);?></td>
						<td class="dl"><?php echo !empty($partition['User']['username']) ? $this->Html->link($this->Html->cText($partition['User']['username'],false), array('controller'=> 'users', 'action'=>'view', $partition['User']['username'], 'admin' => false), array('escape' => false,'title' => $this->Html->cText($partition['User']['username'],false))) : "";?></td>
						<td class="dc"><?php echo $this->Html->cInt($partition['Partition']['custom_price_per_type_count']);?></td>
						<td class="dc"><?php echo $this->Html->cInt($partition['Partition']['no_of_rows']);?></td>						
						<td class="dc"><?php echo $this->Html->cInt($partition['Partition']['no_of_columns']);?></td>
						<td class="dc"><?php echo $this->Html->cInt($partition['Partition']['seat_count']);?></td>
					</tr>
			<?php
				}
			}else{
			?>
				<tr>
					<td colspan="6">
						<div class="space dc">
							<p class="ver-mspace grayc top-space text-16 "><?php echo __l('No Partitions available');?></p>
						</div>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
		</table>
		<?php if (!empty($partitions)){  ?>
		<div class="admin-select-block ver-mspace pull-left mob-clr dc">
			<div class="span top-mspace">
				<span class="graydarkc"><?php echo __l('Select:'); ?></span>
				<?php 
				echo $this->Html->link(__l('All'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-list"}','title' => __l('All'))); 
				echo $this->Html->link(__l('None'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title' => __l('None'))); 
				if(!isset($this->request->params['named']['filter_id'])) {
					echo $this->Html->link(__l('Enable'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-active", "unchecked":"js-checkbox-inactive"}', 'title' => __l('Enable'))); 
					echo $this->Html->link(__l('Disable'), '#', array('class' => 'hor-smspace grayc js-select js-no-pjax {"checked":"js-checkbox-inactive", "unchecked":"js-checkbox-active"}', 'title' => __l('Disable'))); 
				} 
				?>
			</div>
			<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit js-no-pjax span5', 'div'=>false,'label' => false, 'empty' => __l('-- More actions --'))); ?></span>
		</div>
		<?php } ?>
		<div class="js-pagination pagination pull-right no-mar mob-clr dc">  <?php echo $this->element('paging_links'); ?> </div>
	</div>
	<div class="hide"> <?php echo $this->Form->submit(__l('Submit'));  ?>  </div>
</div>
<?php echo $this->Form->end(); ?>
</div>