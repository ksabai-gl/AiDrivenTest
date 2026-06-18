<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dòng ngôn ngữ xác thực (Validation)
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau chứa thông báo lỗi mặc định được sử dụng bởi
    | lớp xác thực. Một số rule có nhiều phiên bản, ví dụ như rule về kích thước.
    | Bạn có thể tự do chỉnh sửa các thông báo này cho phù hợp với ứng dụng.
    |
    */

    'accepted' => 'Vui lòng chấp nhận :attribute.',
    'accepted_if' => 'Vui lòng chấp nhận :attribute khi :other là :value.',
    'active_url' => ':attribute không phải là URL hợp lệ.',
    'after' => ':attribute phải là ngày sau :date.',
    'after_or_equal' => ':attribute phải là ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ được chứa chữ cái.',
    'alpha_dash' => ':attribute chỉ được chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ được chứa chữ cái và số.',
    'any_of' => 'Giá trị của :attribute không hợp lệ.',
    'array' => ':attribute phải là một mảng.',
    'ascii' => ':attribute chỉ được chứa ký tự ASCII.',
    'before' => ':attribute phải là ngày trước :date.',
    'before_or_equal' => ':attribute phải là ngày trước hoặc bằng :date.',

    'between' => [
        'array' => ':attribute phải có từ :min đến :max phần tử.',
        'file' => ':attribute phải có dung lượng từ :min KB đến :max KB.',
        'numeric' => ':attribute phải nằm trong khoảng từ :min đến :max.',
        'string' => ':attribute phải có từ :min đến :max ký tự.',
    ],

    'boolean' => ':attribute phải là true hoặc false.',
    'can' => ':attribute chứa giá trị không được phép.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'contains' => ':attribute không chứa giá trị bắt buộc.',
    'current_password' => 'Mật khẩu hiện tại không đúng.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là ngày bằng với :date.',
    'date_format' => ':attribute không đúng định dạng :format.',
    'decimal' => ':attribute phải có :decimal chữ số thập phân.',
    'declined' => 'Vui lòng từ chối :attribute.',
    'declined_if' => 'Vui lòng từ chối :attribute khi :other là :value.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải có :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions' => 'Kích thước hình ảnh của :attribute không hợp lệ.',
    'distinct' => ':attribute có giá trị bị trùng lặp.',
    'doesnt_contain' => ':attribute không được chứa các giá trị sau: :values',
    'doesnt_end_with' => ':attribute không được kết thúc bằng các giá trị sau: :values',
    'doesnt_start_with' => ':attribute không được bắt đầu bằng các giá trị sau: :values',
    'email' => ':attribute phải là địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong các giá trị sau: :values',
    'enum' => ':attribute được chọn không hợp lệ.',
    'exists' => ':attribute được chọn không hợp lệ.',
    'extensions' => ':attribute phải có một trong các phần mở rộng sau: :values',
    'file' => ':attribute phải là một tệp tin.',
    'filled' => 'Vui lòng nhập :attribute.',

    'gt' => [
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
        'file' => ':attribute phải lớn hơn :value KB.',
        'numeric' => ':attribute phải lớn hơn :value.',
        'string' => ':attribute phải dài hơn :value ký tự.',
    ],

    'gte' => [
        'array' => ':attribute phải có ít nhất :value phần tử.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value KB.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'string' => ':attribute phải có ít nhất :value ký tự.',
    ],

    'hex_color' => ':attribute phải là mã màu hex hợp lệ.',
    'image' => ':attribute phải là hình ảnh.',
    'in' => ':attribute được chọn không hợp lệ.',
    'in_array' => ':attribute phải tồn tại trong :other.',
    'in_array_keys' => ':attribute phải chứa một trong các khóa sau: :values',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là chuỗi JSON hợp lệ.',
    'list' => ':attribute phải là danh sách.',
    'lowercase' => ':attribute chỉ được chứa chữ thường.',

    'lt' => [
        'array' => ':attribute phải có ít hơn :value phần tử.',
        'file' => ':attribute phải nhỏ hơn :value KB.',
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'string' => ':attribute phải ngắn hơn :value ký tự.',
    ],

    'lte' => [
        'array' => ':attribute phải có tối đa :value phần tử.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value KB.',
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => ':attribute phải có tối đa :value ký tự.',
    ],

    'mac_address' => ':attribute phải là địa chỉ MAC hợp lệ.',

    'max' => [
        'array' => ':attribute không được vượt quá :max phần tử.',
        'file' => ':attribute không được lớn hơn :max KB.',
        'numeric' => ':attribute không được lớn hơn :max.',
        'string' => ':attribute không được dài hơn :max ký tự.',
    ],

    'max_digits' => ':attribute không được vượt quá :max chữ số.',
    'mimes' => ':attribute phải là tệp có định dạng: :values',
    'mimetypes' => ':attribute phải là tệp có kiểu: :values',

    'min' => [
        'array' => ':attribute phải có ít nhất :min phần tử.',
        'file' => ':attribute phải có dung lượng tối thiểu :min KB.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :min.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],

    'min_digits' => ':attribute phải có ít nhất :min chữ số.',
    'missing' => 'Không được nhập :attribute.',
    'missing_if' => 'Không được nhập :attribute khi :other là :value.',
    'missing_unless' => 'Không được nhập :attribute trừ khi :other là :value.',
    'missing_with' => 'Không được nhập :attribute khi có :values.',
    'missing_with_all' => 'Không được nhập :attribute khi có :values.',
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => ':attribute được chọn không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute phải là số.',

    'password' => [
        'letters' => ':attribute phải chứa ít nhất một chữ cái.',
        'mixed' => ':attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => ':attribute phải chứa ít nhất một chữ số.',
        'symbols' => ':attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => ':attribute đã bị lộ trong một vụ rò rỉ dữ liệu. Vui lòng chọn giá trị khác.',
    ],

    'present' => 'Trường :attribute phải tồn tại.',
    'present_if' => 'Trường :attribute phải tồn tại khi :other là :value.',
    'present_unless' => 'Trường :attribute phải tồn tại trừ khi :other là :value.',
    'present_with' => 'Trường :attribute phải tồn tại khi có :values.',
    'present_with_all' => 'Trường :attribute phải tồn tại khi có :values.',
    'prohibited' => 'Không được phép nhập :attribute.',
    'prohibited_if' => 'Không được phép nhập :attribute khi :other là :value.',
    'prohibited_if_accepted' => 'Không được phép nhập :attribute khi :other được chấp nhận.',
    'prohibited_if_declined' => 'Không được phép nhập :attribute khi :other bị từ chối.',
    'prohibited_unless' => 'Không được phép nhập :attribute trừ khi :other nằm trong :values.',
    'prohibits' => 'Khi nhập :attribute thì không được nhập :other.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => ':attribute là bắt buộc.',
    'required_array_keys' => ':attribute phải chứa các khóa sau: :values',
    'required_if' => ':attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => ':attribute là bắt buộc khi :other được chấp nhận.',
    'required_if_declined' => ':attribute là bắt buộc khi :other bị từ chối.',
    'required_unless' => ':attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => ':attribute là bắt buộc khi có :values.',
    'required_with_all' => ':attribute là bắt buộc khi có :values.',
    'required_without' => ':attribute là bắt buộc khi không có :values.',
    'required_without_all' => ':attribute là bắt buộc khi không có bất kỳ :values nào.',
    'same' => ':attribute và :other không khớp.',

    'size' => [
        'array' => ':attribute phải có :size phần tử.',
        'file' => ':attribute phải có dung lượng :size KB.',
        'numeric' => ':attribute phải bằng :size.',
        'string' => ':attribute phải có :size ký tự.',
    ],

    'starts_with' => ':attribute phải bắt đầu bằng một trong các giá trị sau: :values',
    'string' => ':attribute phải là chuỗi.',
    'timezone' => ':attribute phải là múi giờ hợp lệ.',
    'unique' => ':attribute đã tồn tại.',
    'uploaded' => 'Tải lên :attribute thất bại.',
    'uppercase' => ':attribute chỉ được chứa chữ hoa.',
    'url' => ':attribute phải là URL hợp lệ.',
    'ulid' => ':attribute phải là ULID hợp lệ.',
    'uuid' => ':attribute phải là UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Dòng ngôn ngữ xác thực tuỳ chỉnh
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tên thuộc tính tuỳ chỉnh
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'supplier_id' => 'Nhà cung cấp',
        'purchase_date' => 'Ngày mua hàng',
        'expected_date' => 'Ngày dự kiến nhận hàng',
        'shipping_fee' => 'Phí vận chuyển',
        'payment_method' => 'Phương thức thanh toán',
        'hotline' => 'Hotline',
        'customer_id' => 'Khách hàng',
        'order_date' => 'Ngày đặt hàng',
        'expected_delivery_date' => 'Ngày giao hàng dự kiến',
        'type' => 'Loại đơn hàng',
        'order_no' => 'Mã đơn hàng',
        'address_shipping' => 'Địa chỉ giao hàng',
        'customer_name' => 'Tên khách hàng',
        'unit_price' => 'Đơn giá',
        'total_price' => 'Tổng tiền',
        'category_id' => 'Danh mục sản phẩm',
        'sku' => 'Mã SKU',
        'name' => 'Tên',
        'unit' => 'Đơn vị tính',
        'description' => 'Mô tả',
        'unit_name' => 'Tên đơn vị',
        'phone' => 'Số điện thoại',
        'address' => 'Địa chỉ',
        'tax_code' => 'Mã số thuế',
        'bank_account' => 'Số tài khoản ngân hàng',
        'contact_name' => 'Tên người liên hệ',
        'product_id' => 'Sản phẩm',
        'warehouse_id' => 'Kho hàng',
        'qty_adjusted' => 'Số lượng điều chỉnh',
        'reason' => 'Lý do điều chỉnh',
        'adjustment_date' => 'Ngày điều chỉnh',
        'current_qty' => 'Số lượng hiện tại',
        'new_qty' => 'Số lượng sau điều chỉnh',
        'email' => 'Email',
        'logo_url' => 'Logo',
        'bank_name' => 'Tên ngân hàng',
        'bank_account_number' => 'Số tài khoản ngân hàng',
        'bank_account_name' => 'Tên chủ tài khoản',
        'tax' => 'Thuế (%)',

        'attributes' => 'Thuộc tính',
        'attributes.*.key' => 'Tên thuộc tính',
        'attributes.*.type' => 'Loại thuộc tính',
        'attributes.*.value' => 'Giá trị thuộc tính',

        'group' => 'Nhóm khách hàng',
        'website' => 'Website',
        'note' => 'Ghi chú',
        'business_id' => 'Doanh nghiệp',
        'document_no' => 'Số hóa đơn',
        'amount' => 'Số tiền',
        'invoice_date' => 'Ngày hóa đơn',
        'payment_status' => 'Trạng thái thanh toán',
        'approved' => 'Trạng thái phê duyệt',
        'file' => 'Tệp tin',
        'quantity' => 'Số lượng',
        'reserved_qty' => 'Số lượng giữ chỗ',
        'stock_in_id' => 'Phiếu nhập kho',
        'stock_out_id' => 'Phiếu xuất kho',
        'purchase_id' => 'Đơn mua hàng',
        'subtotal' => 'Tạm tính',
        'discount' => 'Chiết khấu',
        'total' => 'Tổng tiền',
        'due_date' => 'Ngày đến hạn',
        'order_id' => 'Đơn hàng',
        'inventory_id' => 'Hàng tồn kho',

        'buy_quantity' => 'Số lượng mua',
        'gift_quantity' => 'Số lượng tặng',
        'compensation_quantity' => 'Số lượng bù trừ',
        'conversion_quantity' => 'Số lượng quy đổi',

        'price' => 'Giá bán',
        'receiver_name' => 'Tên người nhận',
        'receiver_phone' => 'Số điện thoại người nhận',
        'receiver_address' => 'Địa chỉ nhận hàng',
        'receiver_note' => 'Ghi chú người nhận',

        'preferred_unit' => 'Đơn vị vận chuyển',
        'shipping_fee_estimated' => 'Phí vận chuyển ước tính',
        'shipping_code' => 'Mã vận đơn',
        'shipping_fee_actual' => 'Phí vận chuyển thực tế',
        'shipped_at' => 'Ngày gửi hàng',
        'delivered_at' => 'Ngày giao hàng',

        'customer_group_id' => 'Nhóm khách hàng',
        'image' => 'Hình ảnh',
        'product_link' => 'Liên kết sản phẩm',
        'unit_cost' => 'Giá nhập',

        'id' => 'Đơn mua hàng',
        'purchase_items_id' => 'Danh sách sản phẩm mua',
        'purchase_items_id.*' => 'Sản phẩm trong đơn mua',

        'code' => 'Mã',
        'logo' => 'Logo',
        'active' => 'Trạng thái hoạt động',
        'import_date' => 'Ngày nhập kho',
        'status' => 'Trạng thái',
        'qty_change' => 'Số lượng xuất',
        'purchase_item_id' => 'Sản phẩm trong đơn mua',
        'role' => 'Vai trò',
    ],

];
