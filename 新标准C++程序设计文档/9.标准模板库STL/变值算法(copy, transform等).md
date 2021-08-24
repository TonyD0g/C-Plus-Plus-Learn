* transform

  *  对[first,last)中的每个迭代器 I ,执行 uop( * I ) ; 并将结果依次放入从 x 开始的地方。要求 uop( * I ) 不得改变 * I 的值。
  * 本模板返回值是个迭代器，即 x + (last-first)， x 可以和 first相等

  ```c++
  template<class InIt, class OutIt, class Unop> 
  OutIt transform(InIt first, InIt last, OutIt x, Unop uop); 
  ```

* copy

  * 对[first,last)复制到dest开始的地方 
  * 要确保从dest开始有足够的空间存放复制过来的元素
  * 返回的迭代器是dest+(last-first)

  ```c++
  iterator copy(iterator first, iterator last, iterator dest) 
  ```

  ```c++
  #include <iostream>
  #include <algorithm>
  #include <string>
  #include <vector>
  #include <array>
  using namespace std;
  
  int Squre(int n) {
      return n*n;
  }
  
  int main() {
      const int SIZE = 10;
  
      array<int, SIZE> arr1{1,2,3,4,5,6,7,8,9,10};
      array<int, SIZE> arr2{};
      array<int, SIZE> arr3{10,20,30,40,50,60,70,80,90,100};
  
      transform(arr1.begin(), arr1.end(), arr2.begin(), Squre);
      for (auto it:arr2) {
          cout << it << " ";
      } cout<<endl;  // 1 4 9 16 25 36 49 64 81 100
  
      copy(arr1.begin(), arr1.end()-1, arr3.begin());
      for_each(arr3.begin(), arr3.end(), [](const int &n){cout<<n<<" ";}); // 1 2 3 4 5 6 7 8 9 100
  
  
      return 0;
  }
  ```

  

  
