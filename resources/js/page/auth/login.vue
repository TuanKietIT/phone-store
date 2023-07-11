<template>
    <div class="relative py-16  to-gray-200">  
    <div class="relative container m-auto px-6 text-gray-500 md:px-12 xl:px-40">
        <div class="m-auto md:w-8/12 lg:w-6/12 xl:w-6/12">
            <div class="rounded-xl bg-white shadow-xl">
                <span class=" is-cancel-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </span>
                <div class="px-6 py-5 sm:px-16">
                    <div class="space-y-4">
                        <h2 class="mb-8 text-center text-2xl text-sky-500 font-bold uppercase">Sign in </h2>
                    </div>
                    <div class="mb-5 text-gray-600">
                        <input type="text"  class="w-full outline-0 px-3 py-2 is-bg-grey-500 py-1 is-input-start"  placeholder="Họ và tên">
                        <span class=" text-red-500 text-[14px] invalid-feedback px-5"></span>
                    </div>
                    <div class="mb-5 text-gray-600">
                        <input type="text"  class="w-full outline-0 px-3 py-2 is-bg-grey-500 py-1 is-input-start"  placeholder="Email"/>
                        <span class=" text-red-500 text-[14px] invalid-feedback px-5"></span>
                    </div>
                    <div class="mb-5 text-gray-600">
                        <input type="text"  class="w-full outline-0 px-3 py-2 is-bg-grey-500 py-1 is-input-start"  placeholder="Mật khẩu"/>
                        <span class=" text-red-500 text-[14px] invalid-feedback px-5"></span>
                    </div>
                    <div class="mb-5 text-gray-600">
                        <input type="text"  class="w-full outline-0 px-3 py-2 is-bg-grey-500 py-1 is-input-start"  placeholder="Xác nhận Mật khẩu"/>
                        <span class=" text-red-500 text-[14px] invalid-feedback px-5"></span>
                    </div>
                    <div class="mb-5 text-gray-600">
                        <input type="text"  class="w-full outline-0 px-3 py-2 is-bg-grey-500 py-1 is-input-start"  placeholder="Xác nhận Mật khẩu"/>
                        <span class=" text-red-500 text-[14px] invalid-feedback px-5"></span>
                    </div>
                    <div class="flex justify-center items-center ">
                        <button type="submit" class="text-white my-2 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Tạo tài khoản</button>
                    </div>
                    <div class="my-4 grid space-y-4">
                        <button class="group h-10 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">
                                <img src="https://tailus.io/sources/blocks/social/preview/images/google.svg" class="absolute left-0 w-5" alt="google logo">
                                <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Đăng nhập bằng Google</span>
                            </div>
                        </button>
                        <button class="group h-10 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                     hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">
                                 <img src="https://upload.wikimedia.org/wikipedia/en/0/04/Facebook_f_logo_%282021%29.svg" class="absolute left-0 w-5" alt="Facebook logo">
                                <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Đăng nhập bằng Facebook</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
</template>