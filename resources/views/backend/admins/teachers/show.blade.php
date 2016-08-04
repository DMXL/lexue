@extends('backend.layouts.app')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <a href="{{ route('admins::teachers.index') }}" class="btn btn-default">
                <i class="fa fa-long-arrow-left"></i> 教师列表
            </a>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-title">
            <h5 class="no-margins vertical-middle">教师信息</h5>
            <div class="ibox-tools ibox-tools-buttons">
                <button class="btn btn-default btn-outline btn-xs"  data-toggle="modal" data-target="#modal-avatar">
                    <i class="fa fa-photo"></i> 修改头像
                </button>
                <a href="{{ route('admins::teachers.edit', $teacher->id) }}" class="btn btn-default btn-outline btn-xs">
                    <i class="fa fa-wrench"></i> 修改信息
                </a>
                <span class="m-l-sm m-r-sm"> - </span>
                <?php
                $enabled = $teacher->enabled;
                $routeAction = $enabled ? 'disable' : 'enable';
                $buttonText = $enabled ? '下线' : '上线';
                $buttonClass = $enabled ? 'warning' : 'primary';
                $faClass = $enabled ? 'arrow-down' : 'arrow-up';
                ?>
                <form action="{{ route('admins::teachers.' . $routeAction, $teacher->id) }}" class="inline" method="post">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <button class="btn btn-{{ $buttonClass }} btn-outline btn-xs"><i class="fa fa-{{ $faClass }}"></i> {{ $buttonText }}</button>
                </form>
                <span class="m-l-sm m-r-sm"> - </span>
                <button class="btn btn-danger btn-outline btn-xs"  data-toggle="modal" data-target="#teacher-delete-modal">
                    <i class="fa fa-trash"></i> 删除
                </button>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">
                    <div class="profile-image">
                        <img src="{{ $teacher->avatar->url('thumb') }}" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="m-b-sm">
                            <h3 class="no-margins">
                                {{ $teacher->name }}
                            </h3>
                        </div>
                        <p>
                            {{ $teacher->description }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table m-b-xs vertical-middle">
                        <tbody>
                        <tr>
                            <td>
                                <strong>教师教龄</strong>
                            </td>
                            <td>
                                <span>
                                    {{ $teacher->years_of_teaching }}
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>课时费用</strong>
                            </td>
                            <td>
                                <span>
                                    {{ $teacher->price }}
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>授课范围</strong>
                            </td>
                            <td>
                                <span>
                                    @each('backend.admins.partials.tag', $teacher->levels->pluck('name'), 'name')
                                </span>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>教师标签</strong>
                            </td>
                            <td>
                                @each('backend.admins.partials.tag', $teacher->labels->pluck('name'), 'name')
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ibox-footer">
            <a href="{{ route('admins::teachers.timeslots.index', $teacher->id) }}" class="btn btn-default">
                <i class="fa fa-clock-o"></i> 课时管理
            </a>
            <a href="{{ route('admins::teachers.timetables.index', $teacher->id) }}" class="btn btn-default">
                <i class="fa fa-calendar"></i> 课表管理
            </a>
        </div>
    </div>

    <div class="modal inmodal fade" id="teacher-delete-modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除教师</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-circle"></i> 删除后将无法恢复
                    </div>
                    <div class="form-group">
                        <div class="text-center">请输入要删除的教师名字以确认</div>
                        <input type="text" class="form-control" v-model="input">
                    </div>
                    <form action="{{ route('admins::teachers.destroy', $teacher->id) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <button class="btn btn-danger btn-block" :disabled="!matched">删除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="modal-avatar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">{{ $teacher->name }}头像</h4>
                </div>
                <div class="modal-body" id="settings">
                    <div id="avatar-upload" avatar="{{ $teacher->avatar_file_name }}">
                        <div>
                            <img v-if="image" :src="image" />
                            <h4 v-else>还没有头像</h4>
                            <button v-if="!added" :class="buttonClass" @click="selectFile">@{{ buttonText }}</button>
                            <button v-show="added" :disabled="uploading" class="btn btn-primary btn-sm" @click="uploadImage" data-style="zoom-in">
                            <i class="fa fa-spinner fa-spin fa-fw" v-show="uploading"></i> 确认
                            </button>
                            <button v-if="added && !uploading" class="btn btn-danger btn-sm" @click="cancelImage">取消</button>
                            <form action="{{ route('admins::teachers.avatar.upload', $teacher->id) }}" method="post" enctype="multipart/form-data">
                                <input type="file" name="avatar" class="hide" @change="onFileChange">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#teacher-delete-modal',
            data: {
                input: ''
            },
            computed: {
                matched() {
                    return this.input.localeCompare('{{ $teacher->name }}') !== -1;
                }
            },
        })
    </script>

    <script>
        new Vue({
            el: '#modal-avatar',
            props: ['avatar'],
            data() {
                return {
                    image: '',
                    added: false,
                    uploading: false
                };
            },
            computed: {
                buttonText: function() {
                    return this.avatar ? "修改" : "上传";
                },
                buttonClass: function() {
                    return this.avatar ? "btn btn-warning btn-sm" : "btn btn-primary btn-sm";
                }
            },
            ready() {
                this.image = this.avatar;
            },
            methods: {
                selectFile(e) {
                    $(e.target).siblings('form').find('input[type=file]').first().click();
                },
                onFileChange(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.createImage(files[0]);
                },
                createImage(file) {
                    this.added = true;
                    var reader = new FileReader();
                    var vm = this;

                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                cancelImage (e) {
                    this.added = false;
                    this.image = this.avatar;
                    $('#avatar-upload').find('input[name=avatar]').val('');
                },
                uploadImage(e) {
                    var vm = this;

                    var form = $('#avatar-upload').find('form')[0];

                    this.uploading = true;

                    $.ajax({
                        url: form.action,
                        type: 'POST',
                        data: new FormData(form),
                        cache: false,
                        contentType: false,
                        processData: false, // Don't process the files
                        success: function(data)
                        {
                            console.log(data);
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, error)
                        {
                            vm.uploading = false;
                            console.log('ERRORS: ' + textStatus + ' - ' + error);
                            toastr['error']("头像上传失败...");
                        }
                    });
                }
            }
        });
    </script>
@endsection