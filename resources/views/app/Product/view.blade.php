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

            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Dados</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Mídia</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Categorias</button>
                </li>
            </ul>

            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade active show" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('adm.updated-product') }}" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{ $product->id }}">

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Nome:" value="{{ $product->name }}">
                                    <label for="floatingName">Nome:</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 mt-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="value" class="form-control" id="floatingValue" placeholder="Valor:" value="{{ $product->value }}">
                                    <label for="floatingValue">Valor:</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 mt-3">
                                <div class="form-floating mb-3">
                                    <input type="number" name="qtd" class="form-control" id="floatingQtd" placeholder="Estoque:" value="{{ $product->qtd }}">
                                    <label for="floatingQtd">Estoque:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating mb-3">
                                    <textarea name="description" class="form-control" placeholder="Descrição:" id="floatingDescription" style="height: 50px;">{{ $product->description }}</textarea>
                                    <label for="floatingDescription">Descrição:</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="text" name="ean" class="form-control" id="floatingEan" placeholder="Código de Barras:" value="{{ $product->ean }}">
                                    <label for="floatingEan">Código de Barras:</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="color" name="color" class="form-control" id="floatingColor" placeholder="Cor:" value="{{ $product->color }}">
                                    <label for="floatingColor">Cor:</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-floating mb-3">
                                    <select name="size" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                        <option value="{{ $product->size }}" selected>{{ $product->size }}</option>
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
                            <div class="col-sm-12 col-md-3 col-lg-3">
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
                            <div class="col-sm-12 col-md-3 col-lg-3">
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
                            <div class="col-sm-12 col-md-3 offset-md-9 offset-lg-9 col-lg-3">
                                <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
                                    <a href="{{ route('adm.list-product') }}" class="btn btn-outline-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-outline-success">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                    
                    <button type="button" class="btn btn-outline-dark w-25 mt-3" data-bs-toggle="modal" data-bs-target="#imageModal"> Associar Imagem </button>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                     </div>

                     @if($images->count() > 0)
                        <table class="table table-sm mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">Prévia </th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($images as $image)
                                    <tr>
                                        <th scope="row"> <img src="{{ asset('storage/products/images/' . $image->file) }}" width="50"></th>
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
                    @endif
                    
                </div>
                <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                    
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                     </div>

                     @if($categoriesProduct->count() > 0)
                        <table class="table table-sm mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">Prévia</th>
                                    <th scope="col">Detalhes</th>
                                    <th scope="col" class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoriesProduct as $category)
                                    <tr>
                                        <td scope="row"><img src="{{ asset('storage/categories/images/' . $category->categoryLabel->photo) }}" width="50"></td>
                                        <th scope="row">
                                            {{ $category->categoryLabel->name }} <br> 
                                            <span class="badge rounded-pill bg-primary">{{ $category->categoryLabel->description }}</span>
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
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

@endsection