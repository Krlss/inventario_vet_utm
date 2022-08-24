<div id="universalModal" name="universalModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="universalModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="modal_form">
                <div class="modal-header">
                    <div class="flex flex-col">
                        <h5 class="font-bold modal-title">{{__('Quick creation of a new category')}}</h5>
                        <small class="header-error text-red-500"></small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="grid grid-cols-1">
                        <!-- Name category -->
                        <div class="flex flex-col px-2 md:mb-0 mb-2">
                            <label for="name">{{__('Name')}}*</label>
                            <input id="name" name="name" class="form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm" placeholder="{{__('Name')}}" required value="{{old('name')}}" />
                            <span class="text-danger error_modal"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="modal_id" id="modal_id" value="" />
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="hidden" name="modal_class" id="modal_class" value="" />
                    <input type="hidden" name="submit" value="" />
                    <button type="submit" class="bg-green-page hover:bg-green-900 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white save">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>