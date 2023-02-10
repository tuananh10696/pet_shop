<!-- Booking Start -->
<div class="container-fluid bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="bg-primary py-5 px-4 px-sm-5">
                    <?= $this->Form->create('contact_form', ['type' => 'get', 'class' => 'py-5']) ?>
                    <div class="form-group">
                        <?= $this->Form->input('name', ['class' => 'form-control border-0 p-4', 'placeholder' => 'Your Name', 'required' => 'required']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('email', ['class' => 'form-control border-0 p-4', 'placeholder' => 'Your Email', 'required' => 'required']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('phone', ['class' => 'form-control border-0 p-4', 'placeholder' => 'Your Phone', 'required' => 'required']) ?>
                    </div>
                    <div class="form-group">
                        <div class="date" id="date" data-target-input="nearest">
                            <?= $this->Form->input('date', ['class' => 'form-control border-0 p-4 datetimepicker-input', 'placeholder' => 'Reservation Date', 'data-target' => '#date', 'data-toggle' => 'datetimepicker', 'required' => 'required']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="time" id="time" data-target-input="nearest">
                            <?= $this->Form->input('time', ['class' => 'form-control border-0 p-4 datetimepicker-input', 'placeholder' => 'Reservation Time', 'data-target' => '#time', 'data-toggle' => 'datetimepicker', 'required' => 'required']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php $form_opt = ['Tắm gội', 'Cắt tỉa', 'Khám Bệnh', 'Mua sắm', 'Tất cả']; ?>
                        <?= $this->Form->control('form_opt', ['label' => false, 'type' => 'select', 'class' => 'custom-select border-0 px-4', 'style' => 'height: 47px;', 'options' => $form_opt]) ?>

                    </div>
                    <div>
                        <button href="/booked" class="btn btn-dark btn-block border-0 py-3" type="submit">Book Now</button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                <h4 class="text-secondary mb-3">Going for a vacation?</h4>
                <h1 class="display-4 mb-4">Book For <span class="text-primary">Your Pet</span></h1>
                <p>Labore vero lorem eos sed aliquy ipsum aliquy sed. Vero dolore dolore takima ipsum lorem rebum</p>
                <div class="row py-2">
                    <div class="col-sm-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <h1 class="flaticon-house font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Pet Boarding</h5>
                            </div>
                            <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <h1 class="flaticon-food font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Pet Feeding</h5>
                            </div>
                            <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <h1 class="flaticon-grooming font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Pet Grooming</h5>
                            </div>
                            <p class="m-0">Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <h1 class="flaticon-toy font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Pet Tranning</h5>
                            </div>
                            <p class="m-0">Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>