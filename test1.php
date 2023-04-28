 <table class="table">
   <tr>
      <th> Staff  </th>
      <th> Monday (day) </th>
      <th> Tuesday (day)</th>
      <th> Wednesday  (day)</th>
      <th> Thursday  (day)</th>
      <th> Friday (day)</th>
      <th> Saturday (day)</th>
      <th> Sunday  (day)</th>
   </tr>
   <?php foreach($allemp as $row): ?>
   <tr>
      <td> 
         <b> <?php echo $row->firstName; ?> , <?php echo $row->lastName; ?></b> <br>
         <?php echo $row->id; ?>
         <br>
      </td>
      <?php   foreach($DaysinWeeks($row->id) as $rows): ?>
      <?php if($rows->week == 3 ):
         ?>
      <td>
         Tuesday
         <?php   //  // out put data  for  this date  ?>
      </td>
      <?php endif; ?>
      <?php if($rows->week == 4 ): ?>
      <td>
         Wednesday
         <?php   //  // out put data  for  this date  ?>
      </td>
      <?php endif; ?>
      <?php endforeach; ?>
   </tr>
   <?php endforeach; ?> 
</table>
