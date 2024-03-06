<div class="container">
    <h2>{{ __('<form>') }}</h2>
    <div class="row">
        <div class="col">

            <form method="POST" action="#" class="needs-validation" novalidate="">

                <input type="hidden" name="_method" value="post">
                <input type="hidden" name="_token" value="" autocomplete="off">
                <input type="hidden" name="_return_url" value="">



                <fieldset class="mb-3">

                    <legend>Information</legend>

                    <div class="mb-3">
                        <label for="form-input-title" class="form-label">Title</label>
                        <input type="text" class="form-control " value="" aria-describedby="form-input-title"
                            maxlength="255" autocomplete="off" required="" id="form-input-title" name="title"
                            aria-label="Title">
                        You should provide a <strong>title.</strong>
                    </div>

                    <div class="mb-3">
                        <label for="form-input-label" class="form-label">Label</label>
                        <input type="text" class="form-control " value="" aria-describedby="form-input-label"
                            maxlength="255" autocomplete="off" id="form-input-label" name="label" aria-label="Label">

                    </div>

                    <div class="mb-3">
                        <label for="form-input-slug" class="form-label">SLUG</label>
                        <input type="text" class="form-control " value="" aria-describedby="form-input-slug"
                            maxlength="255" autocomplete="off" id="form-input-slug" name="slug" aria-label="SLUG">

                    </div>

                    <div class="mb-3">
                        <label for="form-input-page_type" class="form-label">Page Type</label>
                        <input type="text" class="form-control " value=""
                            aria-describedby="form-input-page_type" maxlength="255" id="form-input-page_type"
                            name="page_type" aria-label="Page Type">

                    </div>


                </fieldset>


                <fieldset class="mb-3">

                    <legend>Status</legend>

                    <fieldset>

                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="active" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_active" name="active"
                                        value="1" checked="">
                                    <label class="form-check-label" for="status_active">Active</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="planned" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_planned" name="planned"
                                        value="1">
                                    <label class="form-check-label" for="status_planned">Planned</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="published" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_published"
                                        name="published" value="1">
                                    <label class="form-check-label" for="status_published">Published</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="flagged" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_flagged"
                                        name="flagged" value="1">
                                    <label class="form-check-label" for="status_flagged">Flagged</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="pending" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_pending"
                                        name="pending" value="1">
                                    <label class="form-check-label" for="status_pending">Pending</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="retired" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_retired"
                                        name="retired" value="1">
                                    <label class="form-check-label" for="status_retired">Retired</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="problem" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_problem"
                                        name="problem" value="1">
                                    <label class="form-check-label" for="status_problem">Problem</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="suspended" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_suspended"
                                        name="suspended" value="1">
                                    <label class="form-check-label" for="status_suspended">Suspended</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="unknown" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_unknown"
                                        name="unknown" value="1">
                                    <label class="form-check-label" for="status_unknown">Unknown</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>

                        <legend class="text-warning">Access</legend>


                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="only_admin" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_only_admin"
                                        name="only_admin" value="1">
                                    <label class="form-check-label" for="status_only_admin">Only Admin</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="only_user" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_only_user"
                                        name="only_user" value="1">
                                    <label class="form-check-label" for="status_only_user">Only User</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="only_guest" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_only_guest"
                                        name="only_guest" value="1">
                                    <label class="form-check-label" for="status_only_guest">Only Guest</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="allow_public" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_allow_public"
                                        name="allow_public" value="1">
                                    <label class="form-check-label" for="status_allow_public">Allow Public</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                </fieldset>

                <fieldset class="mb-3">

                    <legend>Publishing</legend>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="form-input-planned_start_at" class="form-label">Planned Start</label>
                                <input type="datetime-local" class="form-control " value=""
                                    aria-describedby="form-input-planned_start_at form-input-help-planned_start_at"
                                    min="2024-03-05T12:00:00" max="2025-03-06T01:43:36"
                                    id="form-input-planned_start_at" name="planned_start_at"
                                    aria-label="Planned Start">
                                <small id="form-input-help-planned_start_at" class="form-text text-muted">The date
                                    must be after yesterday and before next year.</small>

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="form-input-planned_end_at" class="form-label">Planned End</label>
                                <input type="datetime-local" class="form-control " value=""
                                    aria-describedby="form-input-planned_end_at" id="form-input-planned_end_at"
                                    name="planned_end_at" aria-label="Planned End">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="form-input-embargo_at" class="form-label">Embargo Until</label>
                                <input type="datetime-local" class="form-control " value=""
                                    aria-describedby="form-input-embargo_at" id="form-input-embargo_at"
                                    name="embargo_at" aria-label="Embargo Until">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="form-input-published_at" class="form-label">Published</label>
                                <input type="datetime-local" class="form-control " value=""
                                    aria-describedby="form-input-published_at" id="form-input-published_at"
                                    name="published_at" aria-label="Published">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="form-input-released_at" class="form-label">Released</label>
                                <input type="datetime-local" class="form-control " value=""
                                    aria-describedby="form-input-released_at" id="form-input-released_at"
                                    name="released_at" aria-label="Released">

                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset class="mb-3">

                    <legend>Content Details</legend>

                    <div class="mb-3">
                        <label for="form-input-introduction" class="form-label">Introduction</label>
                        <input type="text" class="form-control " value=""
                            aria-describedby="form-input-introduction" maxlength="255" autocomplete="off"
                            id="form-input-introduction" name="introduction" aria-label="Introduction">

                    </div>

                    <div class="mb-3  editor">

                        <label for="form-input-content" class="form-label">Content</label>

                        <textarea id="form-input-content" name="content" class="form-control" aria-label="Content"
                            aria-describedby="form-input-content"></textarea>

                    </div>

                    <div class="mb-3">
                        <label for="form-input-description" class="form-label">Description</label>
                        <input type="text" class="form-control " value=""
                            aria-describedby="form-input-description" maxlength="255" autocomplete="off"
                            id="form-input-description" name="description" aria-label="Description">

                    </div>


                </fieldset>


                <fieldset class="mb-3">
                    <div class="button-group float-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <a class="btn btn-danger" href="#">Cancel</a>
                    </div>
                </fieldset>


            </form>
        </div>
    </div>
</div>


@push('body')
    <script type="application/javascript">
window.onload = function() {
    'use strict';
    if (typeof playground === 'object') {
        playground.forms.editor('#form-input-content');
    }
    if (typeof playground === 'object') {
        playground.forms.validation();
    }
}
</script>
@endpush
