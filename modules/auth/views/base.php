<!--begin::Root-->
<div class="d-flex flex-column flex-root pt-0">
    <div class="page d-flex flex-row flex-column-fluid me-lg-5 py-5" id="page_auth">
    <!--begin::Content-->
        <div class="d-flex flex-row-fluid">
            <!--begin::Container-->
            <div class="d-flex flex-column flex-row-fluid align-items-center">
                <!--begin::Menu-->
                <div class="d-flex flex-column flex-column-fluid mb-5 mb-lg-10">
                <?php $no = 0; foreach($allpage AS $pg) : $num = $no++; $data['sort'] = $form_number[$num];?>
                    <div id="<?= $pg ?>" class="manipulate_page <?= ($pg == $page) ? 'showin' : 'hidin' ?>">
                        <?= $this->load->view('page/'.$pg,$data); ?>
                    </div>
                <?php endforeach;?>
                </div>
            <!--end::Menu-->
            </div>
        <!--begin::Content-->
        </div>
    <!--begin::Content-->
    </div>
</div>
<!--end::Root-->

<div id="kt_app_auth_footer" class="app-footer position-fixed bottom-0 w-100">
    <!--begin::Footer container-->
    <div class="container-fluid  d-flex justify-content-center align-items-center flex-column flex-md-row flex-center flex-md-stack py-2">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table body-->
                <tbody>
                    <tr class="component landing <?= ($page == 'landing') ? 'showin' : 'hidin'; ?>">
                        <td class="text-center w-100px pb-0">
                            <a onclick="page_to(this,'login')" class="btn btn-sm btn-success mt-5 mb-3" style="border-radius: 15px; width: 150px;">
                                Login
                            </a>
                        </td>
                        <td class="text-center w-100px pb-0 ">
                            <a onclick="page_to(this,'register')" class="btn btn-sm btn-success mt-5 mb-3" style="border-radius: 15px; width: 150px;">
                                Daftar
                            </a>
                        </td>
                    </tr>
                    <tr class="component login <?= ($page == 'login') ? 'showin' : 'hidin'; ?>">
                        <td class="text-center w-100px pb-0">
                            <?php if($data['setting']->logo_ojk == 'Y') : ?>
                            <img src="<?= image_check('ojk.png','setting') ?>" width="125" alt="">
                            <?php endif;?>
                            <button id="btn_form_login" type="button" onclick="submit_form(this,'#form_login',<?= $form_number[1] ?>)" class="btn btn-success mt-5 mb-3" style="border-radius: 15px; width: 266px;">
                                Login
                            </button>
                            <p class="fw-normal">Apakah anda belum memiliki akun?<a onclick="page_to(this,'register')" class="text-success ms-1 cursor-pointer"> Daftar sekarang</a></p>
                        </td>
                    </tr>
                    <tr class="component register <?= ($page == 'register') ? 'showin' : 'hidin'; ?>">
                        <td class="text-center w-100px pb-0">
                            
                            <button id="btn_form_register" type="button" onclick="submit_form(this,'#form_register',<?= $form_number[2] ?>)"  class="btn btn-success" style="border-radius: 15px; width: 266px;">
                                Daftar
                            </button>
                            <div class="d-flex justify-content-center align-items-center">
                                <?php if($data['setting']->logo_ojk == 'Y') : ?>
                                <img src="<?= image_check('ojk.png','setting') ?>" width="100" alt="">
                                <?php endif;?>
                                <p class="fw-normal <?= ($data['setting']->logo_ojk == 'Y') ? 'text-start pt-5' : ''; ?>">Apakah anda sudah memiliki akun?<a onclick="page_to(this,'login')" class="text-success ms-1 cursor-pointer"> Masuk sekarang</a></p>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--end::Footer container-->
</div>