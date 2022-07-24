 <div class="modal fade" id="Modalcategory" tabindex="-1" role="dialog" aria-labelledby="Modalcategory" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <div class="flex flex-col">
                     <h5 class="font-bold">{{__('Quick creation of a new category')}}</h5>
                     <small class="header-error text-red-500"></small>
                 </div>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="grid grid-cols-1">
                     <!-- Name category -->
                     <div class="flex flex-col px-2 md:mb-0 mb-2">
                         <label for="name_category">{{__('Name')}}*</label>
                         <input id="name_category" name="name_category" class="form-control border-1 border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent rounded-sm" placeholder="{{__('Name')}}" required value="{{old('name_category')}}" />
                         <span class="text-danger error_category"></span>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="bg-green-page hover:bg-green-900 shadow-sm p-2 px-4 mt-2 rounded-md text-whire font-medium text-white add_category">{{__('Save')}}</button>
             </div>
         </div>
     </div>
 </div>