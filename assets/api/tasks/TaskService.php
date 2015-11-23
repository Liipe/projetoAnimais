<?php
class TaskService {
    
    public function add($json){
        $db = Connection::getDB();
        $task = json_decode($json, true);
        $add = $db->tasks->insert($task);
        return $add;
    }
    
    public function remove($id){
        $db = Connection::getDB();
        $task = $db->tasks[$id];
        
        if(!$task) return;
        
        $task->delete();
        
    }
    
    public function getList(){
        $db = Connection::getDB();
        $tasks = array();
        foreach($db->tasks() as $task) {
           $tasks[] = array (
               'name' => $task['name'],
               'email' => $task['email'],
               'endereco' => $task['endereco'],
               'telefone' => $task['telefone'],
               'rua' => $task['rua'],
               'bairro' => $task['bairro'],
               'numero' => $task['numero'],
               'cidade' => $task['cidade'],
                             
           ); 
        }
        
        return $task;
    }
    
}
?>
