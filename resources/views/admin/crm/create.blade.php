@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-body">
            <section class="card card-body modern-horizontal-wizard">
                <div class=" wizard-modern modern-wizard-example">
                    <div class="bs-stepper-content">



                        <form class="form" id="user_form" method="post" action="#" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">

                                    </table>

                                </div>
                                <div class="col-md-6">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Applicant/Customer:</td>
                                                <td colspan="2">
                                                    <select name="location_upazila" id="applicantname"
                                                        class="form-control form-control-sm" name="applicantname">
                                                        <option value="">Select Applicant/Customer</option>
                                                        <option value="880">(880)Mohammad Ali(E-Network)</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Uplink pop:</td>
                                                <td><input type="text" name="uplink" class="form-control form-control-sm"
                                                        required=""></td>
                                            </tr>


                                            <tr>
                                                <td>Issue Type</td>
                                                <td>
                                                    <select name="issue_type" class="form-control form-control-sm">
                                                        <option value="">Select Type</option>
                                                        <option value="no_issue">No Issue</option>
                                                        <option value="not_responding">Not Responding</option>
                                                        <option value="marketing">Marketing</option>
                                                        <option value="fiber">Fiber</option>
                                                        <option value="support">Support</option>
                                                        <option value="account">Accounts</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Client Type</td>
                                                <td>
                                                    <select name="client_type" class="form-control form-control-sm">
                                                        <option value="">Select Type</option>
                                                        <option value="bandwidth">Bandwidth Client</option>
                                                        <option value="mac">Mac Client</option>
                                                        <option value="corporate">Corporate Client</option>
                                                    </select>
                                                </td>
                                            </tr>





                                        </tbody>
                                    </table>




                                </div>
                                <div class="col-md-6">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Problem Start Date</td>
                                                <td>
                                                    <input type="date" name="start_date"
                                                        class="form-control flatpickr-basic
                                                                                                            flatpickr-input" placeholder="YYYY-MM-DD"
                                                        readonly="readonly">

                                                    {{-- <input type="text" name="start_date" class="datepicker form-control"> --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Issue Details</td>
                                                <td>
                                                    <textarea name="issue_details" class="form-control"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Assign To</td>
                                                <td><select id="userlist" name="user"
                                                        class="select2 select2-hidden-accessible" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="">Select User</option>
                                                        <option value="0">No User</option>
                                                        <option value="1">(1)Rokibul Hasan(rokibul)</option>
                                                        <option value="23">(23)rokibul Hasan(rok)</option>
                                                        <option value="43">(43)Md.Kawcher Ahmed(kawcher)</option>
                                                        <option value="44">(44)Mahbub Sumon(sumon)</option>
                                                        <option value="45">(45)Md.Mehedi Hasan(mehedi)</option>
                                                        <option value="47">(47)Mahbub Alam Razu(razu2664)</option>
                                                        <option value="48">(48)Md.Tofazzal Hossain(Tofazzal)</option>
                                                        <option value="49">(49)Md. Rabbi(rabbi)</option>
                                                        <option value="50">(50)Soikot(soikot)</option>
                                                        <option value="51">(51)Asik Rahaman(asik)</option>
                                                        <option value="52">(52)Md. Shahidul Islam(shahidul)</option>
                                                        <option value="53">(53)Manik Baral(manik)</option>
                                                        <option value="54">(54)Nobo Kumar Shuvo(nkshuvo)</option>
                                                        <option value="55">(55)Muhmmad Imran Hasan(imran)</option>
                                                        <option value="56">(56)Md. Sadek Hossain Khoka(sadek)</option>
                                                        <option value="57">(57)Nazim Uddin(nazim)</option>
                                                        <option value="58">(58)Afsana Akhi(afsana)</option>
                                                        <option value="59">(59)suraya(suraya)</option>
                                                        <option value="60">(60)Delowar hossan shuvo(delowar)</option>
                                                        <option value="61">(61)Md . Kamrul Hasan Shohag(shohag)</option>
                                                        <option value="62">(62)Hridika Islam(hridika)</option>
                                                        <option value="63">(63)22(shathi)</option>
                                                        <option value="64">(64)Masud Kaisar Abir(abir)</option>
                                                        <option value="65">(65)Md.Rashed Khan(rashed)</option>
                                                        <option value="66">(66)Md.Rakib(rakib)</option>
                                                        <option value="67">(67)Md.Ariful Islam(ariful)</option>
                                                        <option value="68">(68)Md.Rezaul(rezaul)</option>
                                                        <option value="69">(69)shawttik chy(shawttik)</option>
                                                        <option value="70">(70)Md.Kawsar ahmed(kawsar)</option>
                                                        <option value="71">(71)kamrun naher sathi(kamrun)</option>
                                                        <option value="72">(72)Asaduzzaman Towfiq(asad)</option>
                                                        <option value="73">(73)Robiul Islam Jewel(robiul)</option>
                                                        <option value="74">(74)Md. Noman Uddin(noman)</option>
                                                        <option value="75">(75)Babul Hossain(babul)</option>
                                                        <option value="76">(76)Muhammad Istiak Ahmed(istiak)</option>
                                                        <option value="77">(77)Shamim(shamim)</option>
                                                        <option value="78">(78)Tahlil(tahlil)</option>
                                                        <option value="79">(79)Md. Abdul Awal Anindow(Anindow)</option>
                                                        <option value="80">(80)Nizarul Islam Prince(nizarul)</option>
                                                        <option value="81">(81)anjan(anjan)</option>
                                                        <option value="82">(82)Hridaka islam rimi(Rimi)</option>
                                                        <option value="83">(83)Atiar rahman(atiar)</option>
                                                        <option value="84">(84)Sumaiya Hossain(sumaiya)</option>
                                                        <option value="85">(85)Md Mostafiq(mostafiq)</option>
                                                        <option value="86">(86)Afroza(Afroza)</option>
                                                        <option value="87">(87)shimul(shimul)</option>
                                                        <option value="88">(88)Tanvir(tanvir)</option>
                                                        <option value="89">(89)Hasibul Alam(Mahin)</option>
                                                        <option value="90">(90)Kasmir Rana(kasmir)</option>
                                                        <option value="91">(91)Mohidul haque(Titu)</option>
                                                        <option value="">()Md Mohidul Haque Titu()</option>
                                                        <option value="93">(93)Shovo Abid(shovo)</option>
                                                        <option value="94">(94)bill(bill)</option>
                                                        <option value="95">(95)Mehedi Sikder(mehedisikder)</option>
                                                        <option value="96">(96)Rajib Hossain(rajib)</option>
                                                        <option value="97">(97)Enamul haque(enamul)</option>
                                                        <option value="98">(98)nazrul(nazrul)</option>
                                                        <option value="99">(99)Md. Abul Kalam Azad(azad)</option>
                                                        <option value="100">(100)rana(rana)</option>
                                                        <option value="101">(101)hira(hira)</option>
                                                        <option value="102">(102)Md Rakibul Islam Sagor(sagor)</option>
                                                        <option value="103">(103)Imran Bin Amir(imran_amir)</option>
                                                        <option value="104">(104)Md. Saidur Rahman
                                                            Sumon(saidur_rahman_sumon)</option>
                                                        <option value="105">(105)arif(arif)</option>
                                                        <option value="106">(106)Kowshik Ami(kowshik)</option>
                                                        <option value="107">(107)Shirin jahan chaity(shirinjahan)</option>
                                                        <option value="108">(108)Yasin Arafat(yasinarafat)</option>
                                                        <option value="109">(109)Somrat Ahmed(somratahmed)</option>
                                                        <option value="110">(110)Arafat Rahman(arafatrahman)</option>
                                                        <option value="111">(111)yetfix(yetfix)</option>
                                                        <option value="112">(112)Mehedi Hasan(mehedihasan)</option>
                                                        <option value="113">(113)Kawcher Ahmed(mkawcher)</option>
                                                        <option value="114">(114)Marketing Admin(madmin)</option>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td>Remark</td>
                                                <td>
                                                    <textarea name="remark" class="form-control"></textarea>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>



                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to List</a>
                                    <input type="submit" value="Submit" class="btn btn-primary pull-right"
                                        style="width:150px">
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('vendor-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">


@endsection
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/workOrder.css">


    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}app-assets/css/plugins/forms/form-wizard.css">

@endsection
@push('style')





@endpush
@section('vendor-js')

    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('/') }}app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

@endsection
@section('page-js')
    <script src="{{ asset('/') }}app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
@endsection
@section('page-js')
    <script src="{{ asset('') }}app-assets/js/scripts/forms/form-wizard.js"></script>
@endsection
