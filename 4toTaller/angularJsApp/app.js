angular.module('MyApp', []);

angular.module('MyApp')
.controller('MyController', function($scope, MyService){
    
    $scope.taskList = [];
    
    $scope.newTask = function(){
      var task = {
        title:$scope.newTaskItem,
        finish:false
      };
      $scope.taskList.push(task);
      $scope.newTaskItem = "";
    }
    
    $scope.removeTask = function(item){
      var index = obtenerIndexDeTaskEnArreglo(item);
      $scope.taskList.splice(index, 1);
    }
    
    $scope.editTask = function(task){
      $scope.taskIndexEditing = obtenerIndexDeTaskEnArreglo(task);
      $scope.taskToEdit = task;
      $scope.editingTask = true;
    }
    
    $scope.okEditing = function(){
      $scope.taskList[$scope.taskIndexEditing] = $scope.taskToEdit;
      $scope.taskToEdit = "";
      $scope.editingTask = false;
    }
    
    $scope.cancelEditing = function(){
      $scope.editingTask = false;
      $scope.taskToEdit = "";
    }
    
    $scope.finishTask = function(item){
      var index = obtenerIndexDeTaskEnArreglo(item);
      $scope.taskList[index].finish = true;
    }
    
    function obtenerIndexDeTaskEnArreglo(task){
      return $scope.taskList.indexOf(task);
    }
    
    $scope.obtenerTodasLasTareas = function(){
      MyService.getAllTask().then(function(allTask){
        console.log('taks', allTask);
        $scope.taskList = allTask.data;
      });
    }
    
    $scope.salvarTodasLasTareas = function(){
      MyService.postAllTask($scope.taskList).then(function(res){
        console.log('res server', res);
      });
    }
    
});




angular.module('MyApp')
.service('MyService', function($http){
  
  var baseUrl = "https://jsonplaceholder.typicode.com/todos";
  
  
  return {
    getAllTask:getAllTask,
    postAllTask:postAllTask
  };
  
  function getAllTask(){
    return $http.get(baseUrl);
  }
  
  function postAllTask(data){
    return $http.post(baseUrl, data);
  }
  
});





