Dynamic QR Attendance - สำหรับ Local Devine

วิธีติดตั้ง
1) แตกไฟล์ ZIP
2) นำโฟลเดอร์ dynamic-attendance-localdevine ไปไว้ในโฟลเดอร์ www ของ Local Devine
   ตัวอย่าง:
   C:\LocalDevine\www\dynamic-attendance-localdevine
3) เปิด Local Devine และ Start PHP/Apache
4) เปิด Browser แล้วเข้า URL ที่ Local Devine กำหนด
   โดยทั่วไปอาจเป็น:
   http://localhost/dynamic-attendance-localdevine/
   หรือ URL ตาม Virtual Host ของ Local Devine

บัญชีทดลอง
ครู:
 username: teacher
 password: 1234

นักเรียน:
 student_id: 65001
 password: 1234

รายละเอียดระบบ
- แยก Login ครู / นักเรียน
- QR Token เปลี่ยนทุก 15 วินาที
- คิวแรกเริ่ม 07:00
- คิวถัดไปเพิ่มทุก 5 นาที
- ป้องกันนักเรียนเช็กซ้ำในคิวเดียวกัน
- สถานะ มา / สาย
- จัดการเพิ่ม/ลบนักเรียน
- ค้นหานักเรียน
- ประวัติการเช็กชื่อ
- Export CSV
- ใช้ไฟล์ JSON เป็นฐานข้อมูล จึงไม่ต้องตั้ง MySQL
- หน้าเว็บธีมดำ-น้ำเงิน Responsive

หมายเหตุ
หน้า QR ใช้บริการ api.qrserver.com เพื่อสร้างรูป QR จึงต้องมีอินเทอร์เน็ต
ถ้าไม่มีอินเทอร์เน็ต สามารถทดสอบด้วยเมนู "กรอก Token" ของนักเรียนได้
