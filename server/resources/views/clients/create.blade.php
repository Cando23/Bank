@extends('layouts.main')
@section('content')
    <form class="row g-3 needs-validation" novalidate>

        <div class="card" style="width: 55rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Personal information</h5>
                <div class="container text-center mb-1">
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Name</span>
                                <input type="text" class="form-control" placeholder="Ivan" aria-label="Name"
                                       aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2">Surname</span>
                                <input type="text" class="form-control" placeholder="Ivanovich" aria-label="Surname"
                                       aria-describedby="basic-addon2">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">Place of Birth</span>
                                <input type="text" class="form-control" placeholder="Place of Birth"
                                       aria-label="Place of Birth"
                                       aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon4">Patronymic</span>
                                <input type="text" class="form-control" placeholder="Ivanov" aria-label="Patronymic"
                                       aria-describedby="basic-addon4">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon5">Birthday</span>
                                <input type="date" class="form-control" value="2001-09-11">
                            </div>
                            <div class="input-group mt-4">
                                <span style="margin-right:10px">Gender :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                           id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                           id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <h5 class="card-title text-center">Passport information</h5>
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon6">Passport Series</span>
                                <input type="text" class="form-control" placeholder="Passport series"
                                       aria-label="Passport series"
                                       aria-describedby="basic-addon6">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon7">Passport Number</span>
                                <input type="text" class="form-control" placeholder="Passport number"
                                       aria-label="Passport number"
                                       aria-describedby="basic-addon7">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon11">Identification number</span>
                                <input type="text" class="form-control" placeholder="Identification number"
                                       aria-label="Identification number"
                                       aria-describedby="basic-addon11">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Registration city</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected value="Minsk">Minsk</option>
                                    <option value="Vitebsk">Vitebsk</option>
                                    <option value="Grodno">Grodno</option>
                                    <option value="Vitebsk">Brest</option>
                                    <option value="Grodno">Mogilev</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon8">Passport issued by</span>
                                <input type="text" class="form-control" placeholder="Passport issued by"
                                       aria-label="Passport issued by"
                                       aria-describedby="basic-addon8">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon9">Passport issue date</span>
                                <input type="date" class="form-control" value="2002-12-23"
                                       aria-label="Passport issue date"
                                       aria-describedby="basic-addon9">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon10">Registration address</span>
                                <input type="text" class="form-control" placeholder="st. Hikaly 9"
                                       aria-label="Registration address"
                                       aria-describedby="basic-addon10">
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title text-center">Contact information</h5>
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect02">Residence city</label>
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected value="Minsk">Minsk</option>
                                    <option value="Vitebsk">Vitebsk</option>
                                    <option value="Grodno">Grodno</option>
                                    <option value="Vitebsk">Brest</option>
                                    <option value="Grodno">Mogilev</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon13">Residence address</span>
                                <input type="text" class="form-control" placeholder="st. Hikaly 9"
                                       aria-label="Residence address"
                                       aria-describedby="basic-addon13">
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon14">Mobile phone</span>
                                <input type="text" class="form-control" placeholder="+375291234567"
                                       aria-label="Residence address"
                                       aria-describedby="basic-addon14">
                            </div>
                        </div>
                        <div class="col-sm-4 px-0">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon15">Home phone</span>
                                <input type="text" class="form-control" placeholder="80294442345"
                                       aria-label="Residence address"
                                       aria-describedby="basic-addon15">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon16">Email</span>
                                <input type="text" class="form-control" placeholder="example@gmail.com"
                                       aria-label="Residence address"
                                       aria-describedby="basic-addon16">
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title text-center">Social information</h5>
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon17">Place of work</span>
                                <input type="text" class="form-control" placeholder="Nezaboodka software"
                                       aria-label="Residence address"
                                       aria-describedby="basic-addon17">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon18">Position at work</span>
                                <input type="text" class="form-control" placeholder="Software developer"
                                       aria-label="Residence address"
                                       aria-describedby="basic-addon18">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
