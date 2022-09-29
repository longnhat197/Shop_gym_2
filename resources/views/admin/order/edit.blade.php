@extends('admin.layout.master')
@section('title','Order Edit')
@section('body')
<!-- Main -->
    <div class="app-main__inner">

        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Order
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form method="post" action="admin/order/{{ $order->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">Order</label>
                                <div class="col-md-9 col-xl-8">
                                    <input required  id="name" placeholder="Name" type="text"
                                        class="form-control" value="{{ $order->orderDetails[0]->product->name }}@if (count($order->orderDetails) > 1) (and {{ count($order->orderDetails) }} other products)
                                        @endif
                                        " disabled>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="status"
                                    class="col-md-3 text-md-right col-form-label">Status</label>
                                <div class="col-md-9 col-xl-8">
                                    <select required name="status" id="status" class="form-control">
                                        <option value="">-- Status --</option>
                                        <option value=0 {{ $order->status == 0 ? 'selected' : ''  }}>
                                            Cancel
                                        </option>
                                        <option value=1 {{ $order->status == 1 ? 'selected' : ''  }}>
                                            Receive Orders
                                        </option>
                                        <option value=2 {{ $order->status == 2 ? 'selected' : ''  }}>
                                            Unconfirmed
                                        </option>
                                        <option value=3 {{ $order->status == 3 ? 'selected' : ''  }}>
                                            Confirmed
                                        </option>
                                        <option value=4 {{ $order->status == 4 ? 'selected' : ''  }}>
                                            Paid
                                        </option>
                                        <option value=5 {{ $order->status == 5 ? 'selected' : ''  }}>
                                            Processing
                                        </option>
                                        <option value=6 {{ $order->status == 6 ? 'selected' : ''  }}>
                                            Shipping
                                        </option>
                                        <option value=7 {{ $order->status == 7 ? 'selected' : ''  }}>
                                            Finish
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="javascript:history.back()" class="border-0 btn btn-outline-danger mr-1">
                                        <span class="btn-icon-wrapper pr-1 opacity-8">
                                            <i class="fa fa-times fa-w-20"></i>
                                        </span>
                                        <span>Cancel</span>
                                    </a>

                                    <button type="submit"
                                        class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection



