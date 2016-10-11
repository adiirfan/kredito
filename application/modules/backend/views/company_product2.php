                  <table id="table1" class="table table-bordered table-striped">
                    <thead>
				
                      <tr>
						<th>No</th>
						 <th>Company</th>
                        <th>Company product name</th>
                        <th>Down Payment</th>
                        <th>Interest Rate</th>
                        <th>Condition</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$i=100;
					$z=1;
					foreach($company_product as $row){
					?>
                      <tr>
                        <td><?php echo $z; ?></td>
						 <td><p><?php echo $row['company_name']; ?></p>
						 <img src="<?php echo base_url() ?>assets/img/<?php echo $row['company_image']; ?>" width="50px" height="50px"></img>
						 </td>
                        <td><?php echo $row['company_product_name']; ?></td>
                        <td><?php echo $row['down_payment']; ?></td>
                        <td><?php echo $row['interest_rate']; ?></td>
                        <td><?php echo $row['company_product_condition']; ?></td>
						<td>
						<a href="<?php echo base_url() ?>app/form_app?idapp=<?php echo $row['company_product_id']  ?>">
						<i class="fa fa-fw fa-pencil" style="font-size:20px;color:yellow;"></i>
						
						<a href="<?php echo base_url() ?>app/form_app?idapp=<?php echo $row['company_product_id']  ?>">
						<i class="fa fa-fw fa-trash" style="font-size:20px;color:red;"></i>
						</td>
                      </tr>
					<?php $z++; }?>
                      
                   
                    </tbody>
                   
                  </table>

