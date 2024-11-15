@extends('app.layout')
@section('title') Produto: {{ $product->name }} @endsection
@section('conteudo')

<div class="pagetitle">
    <h1>Produto: {{ $product->name }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adm.app') }}">Escritório</a></li>
            <li class="breadcrumb-item active">Produto: {{ $product->name }}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card p-5">
        <div class="card-body">
            <h5 class="card-title">Informações do Produto {{ $product->name }}</h5>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="nav flex-column align-items-start nav-pills me-3 pt-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Informações Gerais</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" tabindex="-1">Fotos</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" tabindex="-1">Categorias</button>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <form action="{{ route('adm.updated-product') }}" method="POST">
                                @csrf
                                <input name="id" type="hidden" value="{{ $product->id }}">
        
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:" value="{{ $product->name }}">
                                            <label for="floatingName">Nome:</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-floating mb-3">
                                            <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 200px;">{{ $product->description }}</textarea>
                                            <label for="floatingDescription">Descrição:</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="value" class="form-control" id="floatingValue" placeholder="Valor:" value="{{ $product->value }}">
                                            <label for="floatingValue">Valor:</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="ean" class="form-control" id="floatingEan" placeholder="Código de Barras:" value="{{ $product->ean }}">
                                            <label for="floatingEan">Código de Barras:</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="stock" class="form-control" id="floatingStock" placeholder="Estoque:" value="{{ $product->stock }}">
                                            <label for="floatingStock">Estoque:</label>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="color" name="color" class="form-control" id="floatingColor" placeholder="Cor:" value="{{ $product->color }}">
                                            <label for="floatingColor">Cor:</label>
                                        </div>
                                    </div>
        
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select name="size" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                <option value="{{ $product->size }}" selected>@if(!empty($product->size)) {{ $product->size }} @else Escolha um tamanho @endif</option>
                                                <option value="RN">RN</option>
                                                <option value="P">P</option>
                                                <option value="M">M</option>
                                                <option value="G">G</option>
                                                <option value="GG">GG</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="12">12</option>
                                                <option value="14">14</option>
                                                <option value="16">16</option>
                                                <option disabled>-- Tamanhos de Calçados Infantis --</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                                <option value="32">32</option>
                                                <option value="33">33</option>
                                                <option value="34">34</option>
                                                <option value="35">35</option>
                                                <option disabled>Tamanhos Adultos</option>
                                                <option value="PP">PP (Extra Pequeno)</option>
                                                <option value="P">P (Pequeno)</option>
                                                <option value="M">M (Médio)</option>
                                                <option value="G">G (Grande)</option>
                                                <option value="GG">GG (Extra Grande)</option>
                                                <option value="XG">XG (Extra Grande)</option>
                                                <option value="XGG">XGG (Extra Extra Grande)</option>
                                                <option disabled>Tamanhos de Roupas Adultos (Números)</option>
                                                <option value="36">36</option>
                                                <option value="38">38</option>
                                                <option value="40">40</option>
                                                <option value="42">42</option>
                                                <option value="44">44</option>
                                                <option value="46">46</option>
                                                <option value="48">48</option>
                                                <option value="50">50</option>
                                                <option value="52">52</option>
                                                <option value="54">54</option>
                                                <option value="56">56</option>
                                                <option disabled>Tamanhos de Calçados Adultos</option>
                                                <option value="34">34</option>
                                                <option value="35">35</option>
                                                <option value="36">36</option>
                                                <option value="37">37</option>
                                                <option value="38">38</option>
                                                <option value="39">39</option>
                                                <option value="40">40</option>
                                                <option value="41">41</option>
                                                <option value="42">42</option>
                                                <option value="43">43</option>
                                                <option value="44">44</option>
                                                <option value="45">45</option>
                                                <option value="46">46</option>
                                                <option value="47">47</option>
                                            </select>
                                            <label for="floatingSelect">Tamanho</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select name="type" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                <option value="{{ $product->type }}" selected>{{ $product->labelType() }}</option>
                                                <option value="0">Físico</option>
                                                <option value="1">Digital</option>
                                                <option value="2">Serviço</option>
                                            </select>
                                            <label for="floatingSelect">Tipo</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select name="status" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                <option value="{{ $product->status }}" selected>{{ $product->labelStatus() }}</option>
                                                <option value="1">Disponível</option>
                                                <option value="2">Pendente</option>
                                                <option value="3">Bloqueado</option>
                                                <option value="4">Sem estoque</option>
                                            </select>
                                            <label for="floatingSelect">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select name="unit" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                <option value="{{ $product->unit }}" selected>@if(!empty($product->unit)) {{ $product->unit }} @else Escolha uma unidade @endif</option>
                                                <option value="KM">KM</option>
                                                <option value="MT">MT</option>
                                                <option value="CM">CM</option>
                                                <option value="KG">KG</option>
                                                <option value="G">G</option>
                                            </select>
                                            <label for="floatingSelect">Unidade</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="mark" class="form-control" id="floatingMark" placeholder="Marca:" value="{{ $product->mark }}">
                                            <label for="floatingMark">Marca:</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="btn-group container d-flex align-items-center justify-content-center">
                                            <a href="{{ route('adm.list-product') }}" class="btn btn-outline-danger me-2">Cancelar</a>
                                            <button type="submit" class="btn btn-dark me-3">Atualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <button type="button" class="btn btn-outline-dark mt-3" data-bs-toggle="modal" data-bs-target="#imageModal"> Associar Imagem </button>
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('adm.created-image') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Faça o Upload das imagens</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <div class="col-12">
                                                        <input name="file[]" class="form-control" type="file" accept="image/*" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer btn-group">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-dark">Cadastrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                             </div>
        
                             @if($product->images->count() > 0)
                                <table class="table table-sm table-responsive mt-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Prévia </th>
                                            <th scope="col" class="text-center">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->images as $image)
                                            <tr>
                                                <th scope="row"> <a href="{{ asset('storage/products/images/' . $image->file) }}" target="_blank">Visualizar</a></th>
                                                <td class="text-center">
                                                    <form action="{{ route('adm.deleted-image') }}" method="POST" class="delete">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $image->id }}">
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4 class="mt-5 text-center">Nenhuma imagem utilizada.</h4>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <button type="button" class="btn btn-outline-dark w-25 mt-3" data-bs-toggle="modal" data-bs-target="#categoryModal"> Associar Categoria </button>
                            <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('adm.created-product-category') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Associe suas categorias</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <select name="category_id" class="form-select" id="floatingCategory" aria-label="Categoria">
                                                                <option disabled>Categorias</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>  
                                                                @endforeach
                                                            </select>
                                                            <label for="floatingCategory">Categorias</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer btn-group">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-dark">Cadastrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                             </div>
        
                             @if($product->categories->count() > 0)
                                <table class="table table-sm mt-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Prévia</th>
                                            <th scope="col">Detalhes</th>
                                            <th scope="col" class="text-center">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->categories as $category)
                                            <tr>
                                                <td scope="row">
                                                    @if(!empty($category->photo)) 
                                                        <img src="{{ asset('storage/categories/images/' . $category->photo) }}" width="50"></td>
                                                    @endif
                                                <th scope="row">
                                                    {{ $category->name }} <br> 
                                                    <span class="badge rounded-pill bg-primary">{{ $category->description }}</span>
                                                </th>
                                                <td class="text-center">
                                                    <form action="{{ route('adm.deleted-product-category') }}" method="POST" class="delete">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="submit" class="btn btn-outline-dark"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4 class="mt-5 text-center">Nenhuma categoria utilizada.</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection