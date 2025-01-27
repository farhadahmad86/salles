@extends('layouts/app')
@section('styles')
    <style>
        .tree,
        .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .tree ul {
            margin-left: 1em;
            position: relative
        }

        .tree ul ul {
            margin-left: .5em
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 10px;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button,
        .tree li button:active,
        .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="card" style="width: 500px; height: 600px; margin-right: 20px">
            <div class="card-header">Create Modular Group</div>
            <div class="card-body">
                <form action="{{ route('store_modular_group') }}" method="post" id="modular_group">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Modular Group<span style="color: red">*</span></label>
                                <input type="text" name="modular_group" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col mb-2">
                                <button type="submit" class="btn btn-sm btn-primary btn-top-m" id="insert_schedule_target">Submit</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card" style="width: 700px; height: 600px; overflow: auto">
            <div class="card-header">Choose Groups</div>
            <div class="card-body">
                <div class="row">
                    <label>
                        <input type="checkbox" name="check_all" id="check_all" checked="checked">Check All<span
                            style="color: red">*</span>
                    </label>
                </div>
                <div class="row">
                    <ul id="tree1" class="tree">
                        @foreach (\App\Libraries\Permissions::permissions() as $key1 => $per)
                            <li class="branch" style="cursor: pointer;">
                                <input type="checkbox" name="" value="" checked="checked"
                                    class="check_all">{{ $key1 }}
                                <ul>
                                    @foreach ($per as $key2 => $sub_per)
                                        <li class="" style="cursor: pointer; display: none;"><input type="checkbox"
                                                data-level="third" data-valueone="1" data-valuetwo="0" form="modular_group"
                                                name="module_permissions[]" value="{{ $key2 }}" checked="checked"
                                                class="check_all">{{ $sub_per }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function() {
            $('#modular_group').validate({
                rules: {
                    modular_group: {
                        required: true,
                    },
                    check_all: "required"
                }
            });
        });


        // Tree View
        $.fn.extend({
            treed: function(o) {

                var openedClass = 'glyphicon-minus-sign';
                var closedClass = 'glyphicon-plus-sign';

                if (typeof o != 'undefined') {
                    if (typeof o.openedClass != 'undefined') {
                        openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined') {
                        closedClass = o.closedClass;
                    }
                };

                /* initialize each of the top levels */
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function() {
                    var branch = $(this);
                    branch.prepend("");
                    branch.addClass('branch');
                    branch.on('click', function(e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                /* fire event from the dynamically added icon */
                tree.find('.branch .indicator').each(function() {
                    $(this).on('click', function() {
                        $(this).closest('li').click();
                    });
                });
                /* fire event to open branch if the li contains an anchor instead of text */
                tree.find('.branch>a').each(function() {
                    $(this).on('click', function(e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                /* fire event to open branch if the li contains a button instead of text */
                tree.find('.branch>button').each(function() {
                    $(this).on('click', function(e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });
        /* Initialization of treeviews */
        $('#tree1').treed();

        jQuery("#check_all").change(function() {
            if (this.checked) {
                jQuery('.check_all').prop('checked', true);
            } else {
                jQuery('.check_all').prop('checked', false);
            }
        });

        jQuery("input[type='checkbox']").change(function() {

            if ($(this).is(':checked')) {
                $(this).parent().find('input[type="checkbox"]').prop("checked", true);
            } else {
                $(this).parent().find('input[type="checkbox"]').prop("checked", false);
            }
        });

        jQuery("input[type='checkbox'][data-level='second']").change(function() {
            if ($(this).is(':checked')) {
                var checkbox = $(this).parent().parent().prev();
                checkbox.prop("checked", true);
            } else {
                var level = $(this).attr('data-level');
                var value = $(this).attr('data-value');
                var valueNumber = $(this).attr('data-valueNumber');

                if (level === 'second') {
                    var check2 = true;
                    $('[data-valueNumber=' + valueNumber + ']').each(function() {
                        if ($(this).is(':checked')) {
                            check2 = false;
                        }
                    });
                    if (check2) {
                        checkbox = $(this).parent().parent().prev();
                        checkbox.prop("checked", false);
                    }
                }
            }
        });

        jQuery("input[type='checkbox'][data-level='third']").change(function() {
            if ($(this).is(':checked')) {
                var checkbox = $(this).parent().parent().prev();
                checkbox.prop("checked", true);
                checkbox.parent().parent().prev().prop("checked", true);
            } else {
                var level = $(this).attr('data-level');
                var value1 = $(this).attr('data-valueOne');
                var value2 = $(this).attr('data-valueTwo');

                if (level === 'third') {
                    var check = true;
                    $('[data-valueOne=' + value1 + '][data-valueTwo=' + value2 + ']').each(function() {
                        if ($(this).is(':checked')) {
                            check = false;
                        }
                    })
                    if (check) {
                        checkbox = $(this).parent().parent().prev();
                        checkbox.prop("checked", false);
                        $(this).parent().parent().prev().trigger('change');
                    }
                }
            }
        });
    </script>
@endsection
