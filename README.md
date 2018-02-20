Entities:
===
1. NamHoc
- started: đã khai giảng
- enabled: có thể sửa thông tin HK2, chuyển Nhóm, đổi đội
Use Cases
===
1. Khai giảng:
- Tạo mới Năm Học mới
- Tạo mới Chi Đoàn cho năm học đó
- CALL: $namHoc->chuyenNhom($namHocMoi);
  - $this->setNamSau($namHocMoi);
  - $namHocMoi->setNamTruoc($this); 
    - Chuyển danh sách ThanhVien lên ngoại trừ
      - retention true
      - enabled false
      - thieuNhi false
    - $namHocMoi->setter: started = enabled = true
