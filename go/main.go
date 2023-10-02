package main

import (
	"fmt"
	"net"
	"net/http"
	"net/rpc"

	goridgeRpc "github.com/roadrunner-server/goridge/v3/pkg/rpc"
)

type App struct{}

func (s *App) Hi(name string, r *string) error {
	*r = fmt.Sprintf("Hello, %s!", name)
	return nil
}

func (s *App) CountBytes(file []byte, ret *string) error {
	mime := http.DetectContentType(file)

	*ret = fmt.Sprintf("the file you sent is %d bytes long and its mime type is %s. This may or may not be accurate", len(file), mime)
	return nil
}

func main() {
	ln, err := net.Listen("tcp", ":6001")
	if err != nil {
		panic(err)
	}

	_ = rpc.Register(new(App))

	for {
		conn, err := ln.Accept()
		if err != nil {
			continue
		}
		_ = conn
		go rpc.ServeCodec(goridgeRpc.NewCodec(conn))
	}
}
