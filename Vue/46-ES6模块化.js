var a = 10;
var obj = {};

// export var a = 10;
// export var obj = {};
// export function test(){}
console.log(a);

//在es6中要导出内容，需要使用export关键字
//导出的内容需要放在 花括号中

//也可以直接在变量声明前加上export
export {a, obj}

//下面这种方式可以导出内容，并且设置别名
//如果设置的别名是default，那么在外面导入的时候，就可以直接使用 import 任意名字 from "模块" 拿到这个默认导出项
export {a as 别名, obj as default}


//如果在当前模块内，只有一个需要导出的内容，那么我们可以将其设置为默认导出项
// export default {name: "Jianxq", age: 27}

