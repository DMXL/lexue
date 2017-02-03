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
                    <button class="btn btn-{{ $buttonClass }} btn-xs"><i class="fa fa-{{ $faClass }}"></i> {{ $buttonText }}</button>
                </form>
                <button class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#teacher-delete-modal">
                    <i class="fa fa-trash"></i> 删除
                </button>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-avatar">
                            <i class="fa fa-photo"></i> 修改头像
                        </button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-video">
                            <i class="fa fa-file-video-o"></i> 上传试听课
                        </button>
                        <a href="{{ route('admins::teachers.edit', $teacher->id) }}" class="btn btn-default btn-sm">
                            <i class="fa fa-wrench"></i> 修改信息
                        </a>
                    </div>
                </div>
            </div>
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
                            <td><strong>教师教龄</strong></td>
                            <td><span>{{ $teacher->years_of_teaching }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>课时费用</strong></td>
                            <td><span>{{ $teacher->price }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>授课范围</strong></td>
                            <td><span>@each('backend.admins.partials.tag', $teacher->levels->pluck('name'), 'name')</span></td>
                        </tr>
                        <tr>
                            <td><strong>教师标签</strong></td>
                            <td>@each('backend.admins.partials.tag', $teacher->labels->pluck('name'), 'name')</td>
                        </tr>
                        <tr>
                            <td><strong>试听课程</strong></td>
                            <td>
                                @if($teacher->video_file_name)
                                    <a href="{{ $teacher->video->url() }}" target="_blank">
                                        <span class="label label-primary m-l-xs">查看</span>
                                    </a>
                                @else
                                    <span class="label label-default m-l-xs">未上传</span>
                                @endif
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
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
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

    <div class="modal inmodal fade" id="modal-video" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">{{ $teacher->name }}试听课</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="video-upload">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <span>选择视频文件</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="video" data-url="{{ route('admins::teachers.video.upload', $teacher->id) }}">
                        </span>
                        <br>
                        <br>
                        <!-- The global progress bar -->
                        <div id="progress" class="progress">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <!-- The container for the uploaded files -->
                        <div id="files" class="files">
                            @if($teacher->video_file_name)

                                <video src="{{ $teacher->video->url() }}" controls></video>
                                <br>
                                <span>{{ $teacher->video_file_name }}</span>

                            @endif
                        </div>
                    </div>
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
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = $('#video-form').attr('action'),
                    uploadButton = $('<button/>')
                            .addClass('btn btn-primary')
                            .prop('disabled', true)
                            .text('上传中...')
                            .on('click', function () {
                                var $this = $(this),
                                        data = $this.data();
                                $this
                                        .off('click')
                                        .text('取消')
                                        .on('click', function () {
                                            $this.remove();
                                            data.abort();
                                        });
                                data.submit().always(function () {
                                    $this.remove();
                                });
                            });
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                autoUpload: false,
                acceptFileTypes: /(\.|\/)(mp4|avi)$/i,
                maxFileSize: 50000000,
                success: function(data)
                {
                    console.log(data);
                    location.reload();
                },
                error: function(jqXHR, textStatus, error)
                {
                    console.log('ERRORS: ' + textStatus + ' - ' + error);
                    toastr['error']("试听课上传失败...");
                }
            }).on('fileuploadadd', function (e, data) {
                data.context = $('<div/>');
                $('#files').html(data.context);
                $.each(data.files, function (index, file) {
                    var node = $('<p/>')
                            .append($('<span/>').text(file.name));
                    if (!index) {
                        node
                                .append('<br><br>')
                                .append(uploadButton.clone(true).data(data));
                    }
                    node.appendTo(data.context);
                });
            }).on('fileuploadprocessalways', function (e, data) {
                var index = data.index,
                        file = data.files[index],
                        node = $(data.context.children()[index]);
                if (file.preview) {
                    node
                            .prepend('<br>')
                            .prepend(file.preview);
                }
                if (file.error) {
                    node
                            .append('<br>')
                            .append($('<span class="text-danger"/>').text(file.error));
                }
                if (index + 1 === data.files.length) {
                    data.context.find('button')
                            .text('上传')
                            .prop('disabled', !!data.files.error);
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>

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