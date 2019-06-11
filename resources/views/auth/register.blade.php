@extends('layouts.login')

@section('title', '- Crear Cuenta')

@section('content')
    <section class="register">
        <div class="container">
            <div class="row">
                @if(isset($property))
                    <div class="col-md-4">
                        <h1 class="h3 mb-3 font-weight-normal">Propiedad aleatoria</h1>
                        <div class="card-box-a card-shadow mt-5 mb-5">
                            <div class="img-box-a">
                                @if($property->image_path == null)
                                    <img src="{{'https://via.placeholder.com/683x1024?text='.$property->nombre}}" alt="" class="img-a img-fluid">
                                @else
                                    <img src="{{asset($property->image_path)}}" alt="" class="img-a img-fluid">
                                @endif
                            </div>
                            <div class="card-overlay">
                                <div class="price-box d-flex float-right">
                                    <div class="price-box d-flex float-right">
                                            <h2 class="stars-text">{{ $property->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
                                    </div>
                                </div>
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ url('property?id=').$property->id }}"> {{$property->localidad}},
                                                <br /> {{$property->provincia}},
                                                <br /> {{$property->pais}}</a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <a href={{ url('property?id=').$property->id }} class="link-a"> Ver info y semanas</a>
                                        <span class="ion-ios-arrow-forward"></span>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">Capacidad</h4>
                                                <span>{{$property->capacidad}}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Habitaciones</h4>
                                                <span>{{$property->habitaciones}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="form-register">
                        <h1 class="h3 mb-3 font-weight-normal text-center">Crear una cuenta</h1>
                        <div class="text-center">
                            <p>Ya tienes una cuenta?<p>
                                <a href={{ url('login') }}>Iniciar sesión!</a>
                        </div>
                        <h5 class="text-success">Podrás obtener reservas de una semana entera para una propiedad al participar en subastas</h5>
                        <h5>Solo tienes que pagar: ${{ $normalUserSubscriptionPrice }} por mes!</h5>
                        <hr class="hr-primary">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <h2 style="padding-top: 5px">Datos personales</h2>
                            <label for="inputApellido">Apellido</label>
                            <input type="text" name="apellido" id="inputApellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido" required autofocus>
                            @error('apellido')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" id="inputNombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre" required>
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputPais">Pais</label>
                            <select class="form-control @error('pais') is-invalid @enderror" name="pais" id="inputPais">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Åland Islands">Åland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina" selected>Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                            <label for="inputEmail">Email</label>
                            <input type="text" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required autocomplete="off">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="password-confirm">Confirmar Password</label>
                            <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Contraseña" required autocomplete="off">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputFechaNacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="inputFechaNacimiento" oninput="validarFechaNacimiento()" required autocomplete="off">
                            <div class="invalid-feedback" id="fechaInvalida"></div>
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="DNI" id="inputDNI" class="form-control @error('DNI') is-invalid @enderror" placeholder="DNI" required autocomplete="off">
                            @error('DNI')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <h2>Datos de pago</h2>
                            <label for="inputNumeroTarjeta">Numero</label>
                            <input type="text" name="numero_tarjeta" id="inputNumeroTarjeta" class="form-control @error('numero_tarjeta') is-invalid @enderror" placeholder="**** **** **** ****" minlength="16" maxlength="16" required autocomplete="off">
                            @error('numero_tarjeta')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputMarca">Marca</label>
                            <input type="text" name="marca" id="inputMarca" class="form-control @error('marca') is-invalid @enderror" required>
                            @error('marca')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputTitular">Nombre del Titular</label>
                            <input type="text" name="nombre_titular" id="inputTitular" class="form-control @error('nombre_titular') is-invalid @enderror" required>
                            @error('nombre_titular')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputFechaVencimiento">Fecha de Vencimiento</label>
                            <input type="month" name="fecha_vencimiento" id="inputFechaVencimiento" class="form-control @error('fecha_vencimiento') is-invalid @enderror" placeholder="MM/AA" required autocomplete="off">
                            @error('fecha_vencimiento')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputCvv">CVV</label>
                            <input type="text" name="cvv" id="inputCvv" class="form-control @error('cvv') is-invalid @enderror" placeholder="123" minlength="3" maxlength="3" required autocomplete="off">
                            @error('cvv')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <div class="text-center pt-4">
                                <a href="#modalTOS" data-toggle="modal" data-target="#modalTOS">Ver términos y condiciones</a><br>
                                <input type="checkbox" name="acceptTOS" id="acceptTOS" onclick="validarRegistro()"> Acepto los términos y condiciones
                                <div>
                                    <button class="btn btn-b mb-5" style="width:100%" type="submit" disabled id="buttonCrear">Crear cuenta</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($week))
                    <div class="col-md-4">
                        <h1 class="h3 mb-3 font-weight-normal">Subasta aleatoria</h1>
                        <div class="card-box-a card-shadow mt-5 mb-5">
                            <div class="img-box-a">
                                @if($week->property->image_path == null)
                                    <img src="{{'https://via.placeholder.com/683x1024?text='.$week->property->nombre}}" alt="" class="img-a img-fluid">
                                @else
                                    <img src="{{asset($week->property->image_path)}}" alt="" class="img-a img-fluid">
                                @endif
                            </div>
                            <div class="card-overlay">
                                <div class="price-box d-flex float-right">
                                    @for ($i = 1; $i <= $week->property->estrellas; $i++)
                                        <span><i class="far fa-star fa-2x fa-fw star"></i></span>
                                    @endfor
                                </div>
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ url('property?id=').$week->property->id }}"> {{$week->property->localidad}},
                                                <br /> {{$week->property->provincia}},
                                                <br /> {{$week->property->pais}}</a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="alert-info">Subasta en inscripción</span>
                                        </div>
                                        <a href={{ url('week?id=').$week->id }} class="link-a"> Ver semana</a>
                                        <span class="ion-ios-arrow-forward"></span>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">Fecha</h4>
                                                <span>{{$week->fecha}}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Precio inicial</h4>
                                                <span>${{$week->auction->precio_inicial}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Modal TOS -->
    <div class="modal fade" id="modalTOS" tabindex="-1" role="dialog" aria-labelledby="modalTOSTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTOSLongTitle">Términos y Condiciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="width:100%" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/validacionesRegistro.js') }}"></script>
@endsection