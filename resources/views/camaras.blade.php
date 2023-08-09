<script>
    // decodificacion para poder usar los datos
    var marcas = JSON.parse(@json($marcas));
    var modelos = JSON.parse(@json($modelos));
    var camaras = JSON.parse(@json($camaras));
    var baseUrl = "{{ url('/') }}";
</script>
<div id="display_camaras" class="container" style="display:none">
    <center><h5 class="mt-4">Camaras de Video Vigilancia</h5></center>
    <hr>

    <button class="btn btn-primary mb-1" type="button" id="add_camera" data-bs-toggle="modal" data-bs-target="#modal_camara_nueva"><i class="bi bi-plus-lg"></i> Agregar Camara</button>
    <div class="card">
        <h5 class="card-header">Lista de camaras</h5>
        <div class="card-body">
            <button class="btn btn-danger mb-1" type="button" id="delete_cam" style="display:none;"><i class="bi bi-plus-lg"></i> Eliminar Camara</button>
            
            <div class="row mt-2">
                <table id="table_camaras">
                <thead>
                    <tr>
                        <th>NO. Serie</th>
                        <th>Marca</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal camara nueva -->
    <div class="modal fade" id="modal_camara_nueva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Captura de Nueva Camara</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row div_form">
                    <div class="col-md-12">
                        <form  id="formucams">
                            @csrf
                            <div class="row div_captura">
                                <div class="col-md-4 cont-input">
                                    <div class="form-group">
                                        <label for="cam_marca"> Marca </label>
                                        <select class="form-control" name="cam_marca" id="cam_marca">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 cont-input">
                                    <div class="form-group">
                                        <label for="cam_modelo"> Modelo </label>
                                        <select class="form-control" name="cam_modelo" id="cam_modelo">
                                            <option value>Seleccione...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 cont-input">
                                    <div class="form-group">
                                        <label for="cam_no_serie"> Número de Serie </label>
                                        <input type="text" name="cam_no_serie" id="cam_no_serie" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 cont-input">
                                    <div class="form-group">
                                        <label for="cam_name"> Nombre de la camara </label>
                                        <input type="text" name="cam_name" id="cam_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 cont-input">
                                    <div class="form-group">
                                        <label for="cam_mac"> Direccion MAC del dispositivo </label>
                                        <input type="text" name="cam_mac" id="cam_mac" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-5 cont-input" id="fileCPD3">    
                                    <label for="foto_ubi_cam" class="control-label" style="margin-right: 5px">Fotografia </label>
                                    <span class="badge text-bg-danger">JPG, PNG / 5MB</span>    
                                    <div class="input-group" style="margin-top: 3px">        
                                        <label class="input-group-btn" id="fileCPL3">        
                                        <span class="btn btn-primary">           
                                        <span class="glyphicon glyphicon-open-file"></span> Seleccione…<input id="foto_ubi_cam" name="foto_ubi_cam" type="file" style="display: none">
                                        </span>     
                                        </label>       
                                        <input id="file1" type="text" class="form-control file1" name="file1" readonly="">    
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="save_cam" type="button" class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal camara personal inicio -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_camara_per" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Camara</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row div_form">
                        <div id="foto_camara" class='col-md-12 '>
                            <form  id="form_foto_cam">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-xs-12 col-md-6" id="fileCPD3">    
                                        <label for="foto_ins_cam" class="control-label" style="margin-right: 5px">Fotografia </label>
                                        <span class="label label-danger">JPG, PNG / 5MB</span>    
                                        <div class="input-group" style="margin-top: 3px">        
                                            <label class="input-group-btn" id="fileCPL3">        
                                            <span class="btn btn-primary">           
                                            <span class="glyphicon glyphicon-open-file"></span> Seleccione…<input id="foto_cam" name="foto_cam" type="file" style="display: none">
                                            </span>     
                                            </label>       
                                            <input type="text" class="form-control file4" name="file4" readonly="">    
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <center><button id="save_foto_cam" class='btn btn-primary' type='button' style="display:none; margin-top:10px;"><i class='bi-camera'></i> Agregar foto</button></center>
                            </form>   
                            <center><img id="img_foto_cam_per" class='img-fluid' style="max-width:100%; max-height:100%;"></center><br>
                            <center><p id="mot_per_cam"></p></center>
                        </div>
                        <div class="col-md-12">
                            <center>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success btn-cam-select" type="button" id="instalar_camara" style="margin-left:15px; display:none;"><i class="glyphicon glyphicon-cog"></i> Instalar</button>
                            <button class="btn btn-warning btn-cam-select" type="button" id="mantenimiento_camara" style="margin-left:15px; display:none;"><i class="glyphicon glyphicon-wrench"></i> Dar mantenimiento</button>
                            <button class="btn btn-success btn-cam-select" type="button" id="mantenimiento_camara_fin" style="margin-left:15px; display:none;"><i class="glyphicon glyphicon-ok"></i> Finalizar mantenimiento</button>
                            <button class="btn btn-danger" type="button" id="baja_camara" style="margin-left:15px;"><i class="glyphicon glyphicon-remove"></i> Dar de baja</button>
                            </center>
                        </div>
                    </div>

                    <div class="row" id="display_ins_cam" style="display:none;">
                        <div class="row">
                            <h4 class="orange">Instalación de camara</h4><hr>
                        </div>
                        <div class="col-md-12">
                            <form  id="form_ins_cam">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                            <label for="fecha_ins" class="control-label">Fecha Instalación</label>
                                            <div class='input-group' id='datetimepicker'>
                                                <input type="text" name="fecha_ins" id="fecha_ins" class="form-control class_aux" readonly="">
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mot_ins"> Motivo de la instalación </label>
                                            <input type="text" name="mot_ins" id="mot_ins" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="area_ins"> Area </label>
                                            <select class="form-control" name="area_ins" id="area_ins">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sitio_ins"> Sitio </label>
                                            <select class="form-control" name="sitio_ins" id="sitio_ins">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="servidor_ins"> Servidor donde se instalo </label>
                                            <input type="text" name="servidor_ins" id="servidor_ins" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ip_ins"> Dirección IP </label>
                                            <input type="text" name="ip_ins" id="ip_ins" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-xs-12 col-md-4" id="fileCPD3">    
                                        <label for="foto_ins_cam" class="control-label" style="margin-right: 5px">Fotografia </label>
                                        <span class="label label-danger">JPG, PNG / 5MB</span>    
                                        <div class="input-group" style="margin-top: 3px">        
                                            <label class="input-group-btn" id="fileCPL3">        
                                            <span class="btn btn-primary">           
                                            <span class="glyphicon glyphicon-open-file"></span> Seleccione…<input id="foto_ins_cam" name="foto_ins_cam" type="file" style="display: none">
                                            </span>     
                                            </label>       
                                            <input type="text" class="form-control file2" name="file2" readonly="">    
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-primary div_captura m-2" type="button" data-toggle="dropdown" id="save_ins"><i class="glyphicon glyphicon-save"></i>Guardar</button>
                                    <button type="button" class="btn btn-secondary m-2" id="cancelar_reg_ins" name="cancelar_reg_ins"><i class="glyphicon glyphicon-remove"></i> Cancelar </button>
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row" id="display_mant_cam" style="display:none;">
                        <div class="row">
                            <h4 class="orange">Mantenimiento de camara</h4><hr>
                        </div>
                        <div class="col-md-12">
                            <form  id="form_mant_cam">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                            <label for="fecha_mant" class="control-label">Fecha Mantenimiento</label>
                                            <div class='input-group' id='datetimepicker'>
                                                <input type="text" name="fecha_mant" id="fecha_mant" class="form-control class_aux" readonly="">
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mot_mant"> Motivo del mantenimiento </label>
                                            <input type="text" name="mot_mant" id="mot_mant" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-primary div_captura m-2" type="button" data-toggle="dropdown" id="save_mant"><i class="glyphicon glyphicon-save"></i>Guardar</button>
                                    <button type="button" class="btn btn-secondary m-2" id="cancelar_reg_mant" name="cancelar_reg_mant"><i class="glyphicon glyphicon-remove"></i> Cancelar </button>
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row" id="display_baja_cam" style="display:none;">
                        <div class="row">
                            <h4 class="orange">Baja de camara</h4><hr>
                        </div>
                        <div class="col-md-12">
                            <form  id="form_baja_cam">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                            <label for="fecha_baja" class="control-label">Fecha Baja</label>
                                            <div class='input-group' id='datetimepicker'>
                                                <input type="text" name="fecha_baja" id="fecha_baja" class="form-control class_aux" readonly="">
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mot_baja"> Motivo de la baja </label>
                                            <input type="text" name="mot_baja" id="mot_baja" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-primary div_captura m-2" type="button" data-toggle="dropdown" id="save_baja"><i class="glyphicon glyphicon-save"></i>Guardar</button>
                                    <button type="button" class="btn btn-secondary m-2" id="cancelar_reg_baja" name="cancelar_reg_baja"><i class="glyphicon glyphicon-remove"></i> Cancelar </button>
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src={{asset('js/camaras/link.js')}}></script>
<script src={{asset('js/camaras/init.js?v=2')}}></script>
<script src={{asset('js/camaras/dao.js?v=1')}}></script>
<script src={{asset('js/camaras/function.js?v=1')}}></script>