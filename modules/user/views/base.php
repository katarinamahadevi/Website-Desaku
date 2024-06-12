BASE ATAS
                    <?php $no = 0; foreach($allpage AS $pg) : $num = $no++; $data['form'] = (isset($form_number[$num])) ? $form_number[$num] : '';?>
                    <?php
                        $active = 'hidin';
                        if (isset($web_params1)) {
                            if ($pg == $page && $web_params1 == '') {
                                $active = 'showin';
                            }

                            if ($pg == $page && $web_params1 == (int)$web_params1) {
                                $active = 'showin';
                            }
                        }else{
                            if ($pg == $page) {
                                $active = 'showin';
                            }  
                        }
                        
                    ?>
                    <div id="<?= $pg ?>" class="manipulate_page <?= $active; ?>">
                        <?= $this->load->view('page/'.$pg,$data); ?>
                    </div>
                    <?php endforeach;?>
                    
                    <?php foreach($subpage AS $pg) : $data['form'] = (isset($form_number[array_search(explode('/',$pg)[0],$allpage)])) ? $form_number[array_search(explode('/',$pg)[0],$allpage)] : '';?>
                    <?php
                        $active = 'hidin';
                        if (isset($web_params1)) {
                            if ($pg == $page.'/'.$web_params1) {
                                $active = 'showin';
                            }
                        }
                    ?>
                    <div id="<?= str_replace('/','_',$pg); ?>" class="manipulate_page <?= $active ?>">
                        <?= $this->load->view('page/'.$pg,$data); ?>
                    </div>
                    <?php endforeach;?>
          BASE BAAWAH