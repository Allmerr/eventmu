@extends('studio.layouts.main')
@section('content')

<section class="content mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3" style="position: relative;">
                            <img class="img-fluid img-thumbnail rounded-circle" src="{{ $user->profile->profile_picture !== null ? asset('/storage/' . $user->profile->profile_picture) : 'https://source.unsplash.com/random/1000x1000' }}" alt="User profile picture" style="object-fit: contain; width:200px; height:200px;" >
                            <a href="#" class="d-block btn btn-primary" style="margin-top:-20px; position:absolute; left:0; bottom:0;" data-bs-toggle="modal" data-bs-target="#profilPictureModal"><span data-feather="edit-2"></span> Edit</a>
                        </div>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">{{ $user->profile->caption }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('studio.setting.update_profile') }}" method="POST" onsubmit="validationBeforeSubmit(event, this)">
                            @csrf
                            <div class="form-group mb-1">
                                <label for="name" class='form-label'>name</label>
                                <div class="form-input">
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="nickname" class='form-label'>nickname</label>
                                <div class="form-input">
                                    <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $user->nickname) }}" class="form-control @error('nickname') is-invalid @enderror">
                                </div>
                                <div class="invalid-feedback invalid-feedback-nickname">
                                    Already Used Nickname
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label for="caption" class='form-label'>caption</label>
                                <div class="form-input">
                                    <input type="text" name="caption" id="caption" value="{{ old('caption', $user->profile->caption !== null ? $user->profile->caption : '') }}" class="form-control @error('caption') is-invalid @enderror">
                                </div>
                                @error('caption')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="bio" class='form-label'>bio</label>
                                <div class="form-input">
                                    <textarea class="form-control" id="bio" name="bio" style="height: 70px">{{ old('bio', $user->profile->bio !== null ? $user->profile->bio : '') }}</textarea>
                                </div>
                                @error('bio')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="pronouns" class='form-label'>Pronouns</label>
                                <select class="form-select" name="pronouns" id="pronouns">
                                    <option value="Do not specify" {{ old('pronouns', $user->profile->pronouns) === 'Do not specify' ? 'selected' : ''}}>Do not specify</option>
                                    <option value="he/him" {{ old('pronouns', $user->profile->pronouns) === 'he/him' ? 'selected' : ''}}>he/him</option>
                                    <option value="she/her" {{ old('pronouns', $user->profile->pronouns) === 'she/her' ? 'selected' : ''}}>she/her</option>
                                    <option value="they/them" {{ old('pronouns', $user->profile->pronouns) === 'they/them' ? 'selected' : ''}}>they/them</option>
                                </select>
                                @error('pronouns')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="url" class='form-label'>url</label>
                                <div class="form-input">
                                    <input type="text" name="url" id="url" value="{{ old('url', $user->profile->url) !== null ? $user->profile->url : ''}}" class="form-control @error('url') is-invalid @enderror">
                                </div>
                                @error('url')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="social_accounts" class='form-label'>Social accounts</label>
                                <div class="form-group mb-1">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <span data-feather="link"></span>
                                            @if (isset(explode(',', old('social_accounts', $user->profile->social_accounts) !== null ? $user->profile->social_accounts : '')[$i]))
                                                <input type="text" name="social_accounts_{{ $i+1 }}" id="" value="{{ explode(',', old('social_accounts', $user->profile->social_accounts) !== null ? $user->profile->social_accounts : '')[$i]  }}" class="form-control @error('social_accounts') is-invalid @enderror">
                                            @else
                                                <input type="text" name="social_accounts_{{ $i+1 }}" id="" value="" class="form-control @error('social_accounts') is-invalid @enderror">
                                            @endif

                                        </div>
                                    @endfor
                                    <input type="hidden" name="social_accounts" id="social_accounts">
                                </div>
                                @error('social_accounts')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="location" class='form-label'>location</label>
                                <div class="form-input">
                                    <input type="text" name="location" id="location" value="{{ old('location', $user->profile->location) }}" class="form-control @error('location') is-invalid @enderror">
                                </div>
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" type="submit">Update profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="profilPictureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('studio.setting.update_profile_picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-1">
                        <div class="form-input">
                            <img class="img-preview img-fluid mb-3">
                            <label for="profile_picture" class='form-label'>Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" accept=".jpeg, .jpg, .png," onchange="previewphoto()" required>
                            <small class="form-text text-muted">allowed file extension : .jpeg .jpg .png</small>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-2">Change Profile Picture</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
    // preview function
    function previewphoto(){
        const photo = document.querySelector('#profile_picture');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }

        imgPreview.style.maxWidth = '300px';
        imgPreview.classList.add('img-thumbnail');
    }

    // fetch user function
    const url = '{{ url('/') }}';
    const nicknameInput = document.getElementById('nickname');

    nicknameInput.addEventListener('change', function() {
        const nikcnameValue = this.value;
        fetchUsers(nikcnameValue);
    });

    function fetchUsers(nickname) {
        const oldNickname = '{{ auth()->user()->nickname }}'

        if(nickname === oldNickname){
            document.querySelector('.invalid-feedback-nickname').style.display = 'none';
            nicknameInput.classList.remove('is-invalid')
            nicknameInput.classList.remove('block-submit')
        }


        fetch( url + `/studio/setting/is-nickname-unique/${nickname}`)
            .then(response => {
                return response.json()
            })
            .then(data => {
                if(data['is_unique'] === false){
                    document.querySelector('.invalid-feedback-nickname').style.display = 'block';
                    nicknameInput.classList.add('is-invalid')
                    nicknameInput.classList.add('block-submit')
                }else{
                    document.querySelector('.invalid-feedback-nickname').style.display = 'none';
                    nicknameInput.classList.remove('is-invalid')
                    nicknameInput.classList.remove('block-submit')
                }
            });
    }

    // validation before submit functio onclick="notificationBeforeSubmit(event, this)"n
    function validationBeforeSubmit(event, el){
        event.preventDefault();

        let isFilled = true;
        let errorMessage;

        const socialAccountsInput = document.getElementById('social_accounts');

        el.closest('form').querySelectorAll('input').forEach(input => {
            if (input.name === 'nickname' && !input.value.startsWith('@')){
                isFilled = false;
                errorMessage = 'Nickname must start with \'@\'!';
            }

            if(input.name === 'social_accounts_1' || input.name === 'social_accounts_2' || input.name === 'social_accounts_3' || input.name === 'social_accounts_4'){
                if(input.value !== ''){
                    socialAccountsInput.value += input.value + ',';
                }
            }

            if (input.className.includes('block-submit')) {
                isFilled = false;
                errorMessage = 'Nickname is not valid!';
            }
        });

        if (!isFilled) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errorMessage,
            })
            return;
        }

        if(socialAccountsInput.value.endsWith(',')){
            socialAccountsInput.value = socialAccountsInput.value.slice(0, -1);
        }

        el.closest('form').submit();
    }


</script>

@endpush

@endsection
