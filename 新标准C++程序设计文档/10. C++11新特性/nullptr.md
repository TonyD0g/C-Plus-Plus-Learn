* C中NULL定义为(void*)0

* C++中NULL的值为0

* 解决这种二义性，C++11引入了关键字nullptr， 专门用来表示空指针常量

  ```c++
  #include <iostream>
  using namespace std;
  
  void test(int a ) {
      cout << "int " << endl;
  }
  
  void test(int * b) {
      cout << "int *" << endl;
  }
  
  int main() {
      test(0) ; // int
  //  test(NULL); // 编译错误, call of overloaded ‘test(NULL)’ is ambiguous
  
      test(nullptr); // int *
  
      return 0;
  }
  ```

  

