 <!-- main container -->
 <div class="content">
    <div class="container-fluid">
        <div class="row-fluid" style="">
            <div class="span8">

                <div id="pad-wrapper">
                    <!-- header -->
                    <div class="row-fluid header" style="margin-bottom: 20px;">
                        <div class="span8">
                            <h3 class="name">User List</h3>
                        </div>
                    </div>

                    <div class="row-fluid">
<!--
                     <div class="pagination pull-left">
                        <ul>
                            <li><a href="<? echo base_url('label/letter/characters');?>">#-9</a></li>
                            <li><a href="<? echo base_url('label/letter/a');?>">A</a></li>
                            <li><a href="<? echo base_url('label/letter/b');?>">B</a></li>
                            <li><a href="<? echo base_url('label/letter/c');?>">C</a></li>
                            <li><a href="<? echo base_url('label/letter/d');?>">D</a></li>
                            <li><a href="<? echo base_url('label/letter/e');?>">E</a></li>
                            <li><a href="<? echo base_url('label/letter/f');?>">F</a></li>
                            <li><a href="<? echo base_url('label/letter/g');?>">G</a></li>
                            <li><a href="<? echo base_url('label/letter/h');?>">H</a></li>
                            <li><a href="<? echo base_url('label/letter/i');?>">I</a></li>
                            <li><a href="<? echo base_url('label/letter/j');?>">J</a></li>
                            <li><a href="<? echo base_url('label/letter/k');?>">K</a></li>
                            <li><a href="<? echo base_url('label/letter/l');?>">L</a></li>
                            <li><a href="<? echo base_url('label/letter/m');?>">M</a></li>

                        </ul>
                    </div>
                    <div class="pagination pull-left">
                        <ul>
                            <li><a href="<? echo base_url('label/letter/n');?>">N</a></li>
                            <li><a href="<? echo base_url('label/letter/o');?>">O</a></li>
                            <li><a href="<? echo base_url('label/letter/p');?>">P</a></li>
                            <li><a href="<? echo base_url('label/letter/q');?>">Q</a></li>
                            <li><a href="<? echo base_url('label/letter/r');?>">R</a></li>
                            <li><a href="<? echo base_url('label/letter/s');?>">S</a></li>
                            <li><a href="<? echo base_url('label/letter/t');?>">T</a></li>
                            <li><a href="<? echo base_url('label/letter/u');?>">U</a></li>
                            <li><a href="<? echo base_url('label/letter/v');?>">V</a></li>
                            <li><a href="<? echo base_url('label/letter/w');?>">W</a></li>
                            <li><a href="<? echo base_url('label/letter/x');?>">X</a></li>
                            <li><a href="<? echo base_url('label/letter/y');?>">Y</a></li>
                            <li><a href="<? echo base_url('label/letter/z');?>">Z</a></li>                
                        </ul>
                    </div>
                    -->
                </div>
                <div class="row-fluid">
                  <br>
                  <div class="row-fluid">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span9">
                                    User
                                </th>
                                <th class="span3">
                                    -
                                </th> 
                            </tr>
                        </thead>
                        <tbody>

                            <?  
                            foreach ($users as $row)
                            { 
                                ?>

                                <!-- row -->
                                <tr class="first">

                                    <td>
                                        <a href="<? echo base_url('users/v/'.$row->username);?>" class="link" target="_blank" style="font-size: 14px;">
                                        <? echo $row->username; ?></a>
                                    </td>
                                    <td>
                                            -
                                    </td>
                                   
                                </tr>
                                <? 
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
